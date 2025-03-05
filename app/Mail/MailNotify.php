<?php
  
namespace App\Mail;
  
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
  
class MailNotify extends Mailable
{
    use Queueable, SerializesModels;
  
    public $data=[];
    public $subject ="";
    public $template ="";
    public $from_mail ="";
    public $from_name ="";
    public $reply_to ="";
  
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from_mail,$from_name,$reply_to,$subject,$data,$template)
    {
        $this->data= $data;
        $this->subject= $subject;
        $this->template= $template;
        $this->from_mail= $from_mail;
        $this->from_name= $from_name;
        $this->reply_to= $reply_to;
    }
  
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), $this->from_name)
        ->replyTo($this->reply_to)
        ->subject($this->subject)
                    ->view('emails.'.$this->template,$this->data);
    }
}