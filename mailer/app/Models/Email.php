<?php

namespace App\Models;

class Email
{
    public $content;
    public $replyto;
    public $to;
    public $subject;
    public $attachments;



    public function __construct($object)
    {
        $this->content = $object['content'] ?? null;
        $this->replyto = $object['replyto'] ?? null;
        $this->to = $object['to'] ?? null;
        $this->subject = $object['subject'] ?? null;
        $this->attachments = $object['attachments'] ?? null;
    }
}
