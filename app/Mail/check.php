<?php
/**
 * Created by PhpStorm.
 * User: paditech
 * Date: 8/22/2018
 * Time: 3:40 PM
 */

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;

class check
{
    use Queueable, SerializesModels;
    protected $infomation;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($infomation)
    {
        $this->infomation = $infomation;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return
            $this->view('mail.check')->with('infomation',$this->infomation);
    }
}