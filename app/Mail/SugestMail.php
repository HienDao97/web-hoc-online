<?php
/**
 * Created by PhpStorm.
 * User: paditech
 * Date: 9/3/19
 * Time: 12:39 AM
 */
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
class SugestMail extends Mailable
{
    use Queueable, SerializesModels;
    protected $params;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($params)
    {
        $this->params = $params;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.goi-y')->subject("Gợi ý học sinh")->with('params',$this->params);
    }
}