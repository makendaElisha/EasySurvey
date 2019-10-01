<?php

namespace App\Listeners;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\SendSurvey;
use App\Token;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class SendLinkToEmailListener implements ShouldQueue
{
    
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $token = new Token(); 
        $token->id = Str::random(40);
        $token->category_id = $event->category->id;
        $token->save();
        sleep(3); // wait of 3 seconds because using mailtrap which free version doesn't allow many emails at a time. 
        Mail::to($event->email)->send(new SendSurvey($token));
    }
}
