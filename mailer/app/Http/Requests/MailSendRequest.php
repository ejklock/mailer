<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailSendRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        return [
            'to' => ['sometimes', 'required', 'regex:/^(\s?[^\s,]+@[^\s,]+\.[^\s,]+\s?,)*(\s?[^\s,]+@[^\s,]+\.[^\s,]+)$/'],
            'toFile' => 'sometimes|required|file',
            'anexos.*' => 'sometimes|mimetypes:image/jpeg,image/png,image/jpg,image/gif,image/svg,application/pdf',
            'replyto' => 'email',
            'content' => 'required',
            'subject' => 'required',
        ];
    }

    public function messages()
    {
        return
            [
                'to.regex' => 'O campo de destinatários deve ter email(s) no formato válido(s)',
                'to.required' => 'Pelo menos um destinatário deve ser informado',
                'replyto.required' => 'Deve ser informado um email no campo Responder para',
                'subject.required' => 'Deve ser informado o assunto do email',

            ];
    }

    /*  public function withValidator($validator)
{

$validator->after(function ($data) {
dd($data);
});
} */
}
