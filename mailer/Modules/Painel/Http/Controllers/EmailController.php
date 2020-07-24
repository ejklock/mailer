<?php

namespace Modules\Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\Email;
use App\Models\MailTemplate;
use App\Http\Requests\MailSendRequest;
use App\Imports\EmailImport;
use App\Jobs\SendMail;
use RealRashid\SweetAlert\Facades\Alert;

class EmailController extends Controller
{
    protected $email;
    protected $attachments;
    protected $for;

    public function __construct()
    {
        $this->email = array();
        $this->attachments = array();
    }

    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(MailTemplate $mailTemplate)
    {
        $templates = $mailTemplate->orderBy('name')->get();
        return view('painel::email.index')->with(['templates' => $templates]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('painel::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(MailSendRequest $request)
    {
        try {
            $this->email = new Email(
                $request->except('anexos', 'to', '_token')
            );

            if ($request->file('toFile')) {
                $import = new EmailImport();
                $collection = $import
                    ->toCollection($request->file('toFile'))
                    ->first();
                $this->for = $collection
                    ->filter(function ($item) {
                        return $item->validate('email');
                    })
                    ->pluck('email')
                    ->toArray();
                $this->for = array_diff(
                    \filter_var_array($this->for, FILTER_VALIDATE_EMAIL, false),
                    [false]
                );
            } else {
                $this->for = explode(',', $request->to);
                $this->for = array_map('strtolower', $this->for);
                $this->for = array_diff(
                    \filter_var_array($this->for, FILTER_VALIDATE_EMAIL, false),
                    [false]
                );
            }

            if ($request->file('anexos')) {
                foreach ($request->file('anexos') as $f) {
                    $this->email->attachments[] = [
                        'filename' =>
                            $f->getClientOriginalName() .
                            '.' .
                            $f->getClientOriginalExtension(),
                        'mime' => $f->getMimeType(),
                        'path' => $f->getRealPath(),
                        'bin' => base64_encode(file_get_contents($f))
                    ];
                }
            }

            $this->for = array_chunk($this->for, 50);
            foreach ($this->for as $for) {
                dispatch(new SendMail($this->email, $for))->delay(
                    now()->addMinutes(1)
                );
            }

            Alert::toast(
                'Email(s) foram adicionados a fila para envio. Em Breve serão disparados',
                'info'
            );
        } catch (\Throwable $th) {
            dd($th);
        } finally {
            return redirect()->route('painel.email.index');
        }
    }
}
