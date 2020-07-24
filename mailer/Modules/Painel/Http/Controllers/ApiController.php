<?php

namespace Modules\Painel\Http\Controllers;

use Illuminate\Routing\Controller;
use App\Models\MailTemplate;

class ApiController extends Controller
{
    public function getMailTemplate($id, MailTemplate $mailTemplate)
    {
        return response()->json($mailTemplate->find($id));
    }
}
