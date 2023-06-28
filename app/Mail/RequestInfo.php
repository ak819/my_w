<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RequestInfo extends Mailable
{
    use Queueable, SerializesModels;
     
    protected $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {  
        $subject="Website property enquiry – property reference ".$this->data['propertyno'];
        return $this->from(env('MAIL_FROM_ADDRESS'),env('MAIL_FROM_NAME'))
              ->subject($subject)
              ->view('mails.request-info')->with(['data'=>$this->data]);
    }
}
