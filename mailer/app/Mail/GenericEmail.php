<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;

class GenericEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $email;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->html($this->email->content)
            ->replyTo($this->email->replyto)
            ->subject($this->email->subject);

        if ($this->email->attachments) {
            foreach ($this->email->attachments as $a) {
                $mail->attachData(base64_decode($a['bin']), $a['filename'], [
                    'mime' => $a['mime']
                ]);
            }
        }
        return $mail;
    }
}
