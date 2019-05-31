<?php

namespace App\Jobs;

use App\Mail\check;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $infomation;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($infomation)
    {
        dd(1);
        $this->infomation = $infomation;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
//        sleep(60);

        echo 'Start send email';
        $email = new check($this->infomation);
        Mail::to(env('MAIL_MASTER'))->send($email);

        echo 'End send email';
    }
}
