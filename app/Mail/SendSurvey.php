<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Str;
use App\Token;

class SendSurvey extends Mailable
{
    use Queueable, SerializesModels;

    public $token; 

    //Construct with a variable of type Token
    public function __construct(Token $token)
    {        
        $this->token = $token;        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.survey.send-form'); 
    }
}
