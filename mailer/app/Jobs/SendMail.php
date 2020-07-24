<?php

namespace App\Jobs;

use App\Mail\GenericEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Bus\Dispatchable;
use Log;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 1;

    protected $email;
    protected $for;
    protected $attachments;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $for)
    {
        $this->email = $email;
        $this->for = $for;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $mail = new GenericEmail($this->email);
        Mail::bcc($this->for)->send($mail);
    }
}
