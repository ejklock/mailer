<?php

namespace Modules\Painel\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\MailTemplate;
use App\Http\Requests\MailTemplateCreateRequest;

class MailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Response
     */

    public function index(MailTemplate $mailTemplate)
    {
        $templates = $mailTemplate->all();

        return view('painel::mailtemplate.index')->with([
            'templates' => $templates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        return view('painel::mailtemplate.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Response
     */
    public function store(
        MailTemplateCreateRequest $request,
        MailTemplate $mailTemplate
    ) {
        try {
            $mailTemplate->create($request->all());
            session()->flash('status', 'Template cadastrado com sucesso');
        } catch (\Throwable $e) {
            session()->flash('danger', $e->getMessage());
        } finally {
            return redirect()->route('painel.mailtemplate.index');
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Response
     */
    public function show($id, MailTemplate $mailTemplate)
    {
        try {
            $template = $mailTemplate->findOrFail($id);
            return view('painel::mailtemplate.show')->with([
                'template' => $template
            ]);
        } catch (\Throwable $e) {
            session()->flash('danger', $e->getMessage());
            return redirect()->route('painel.mailtemplate.index');
        }
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Response
     */
    public function edit($id, MailTemplate $mailTemplate)
    {
        try {
            $template = $mailTemplate->findOrFail($id);

            return view('painel::mailtemplate.edit')->with([
                'template' => $template
            ]);
        } catch (\Throwable $e) {
            session()->flash('danger', $e->getMessage());
            return redirect()->route('painel.mailtemplate.index');
        }
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id, MailTemplate $mailTemplate)
    {
        try {
            $template = $mailTemplate->findOrFail($id);
            $template->fill($request->all());
            $template->save();
            session()->flash('status', 'Template Atualizado com sucesso');
        } catch (\Throwable $e) {
            session()->flash('danger', $e->getMessage());
        } finally {
            return redirect()->route('painel.mailtemplate.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Response
     */
    public function destroy($id, MailTemplate $mailTemplate)
    {
        try {
            $mailTemplate->destroy($id);
            session()->flash('status', 'Template deletado com sucesso');
            return redirect()->route('painel.mailtemplate.index');
        } catch (\Throwable $e) {
            session()->flash('danger', $e->getMessage());
            return redirect()->route('painel.mailtemplate.index');
        }
    }
}
