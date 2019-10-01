<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Category;
use App\Events\ReadyToSendSurveyLinkEvent;
use App\Mail\SendSurvey;
use Illuminate\Http\Request;
use App\Question;
use App\User;
use App\Survey;
use App\Token;
use Illuminate\Contracts\Queue\ShouldQueue;

class SurveysController extends Controller 
{
    public function __construct()
    {
        $this->middleware('auth')->only(['send','sendlink']);
    }

    //Show survey of a specific category
    public function take(Category $category, Token $token)
    {
        return view('surveys.take', compact('category', 'token')); 
    }

    //Save completed survey to DB
    public function store(Category $category, Token $token)
    {
        //request validation
        $countQuestions = count($category->questions); 
        request()->validate([
            'radio' => 'required|array|min:'.$countQuestions,
        ]);
        
        $check_token = Token::find($token->id);
        if ( !$check_token) {
            return 'Invalid link';
        }
        
        if($check_token->used == true){
            return 'Survey already submitted before; Information not saved';
        }

        //Put selected answers into a list
        $answers_list = [];
        $i = 0 ;
        $list_index = 0;
        
        foreach ($category->questions as $question) {
            $answers_list[$i] = request('radio')[$question->id];
            $i++;
        }
          
        //Create survey records based on answered values
        foreach ($category->questions as $question) {

            $survey = new Survey();            
            $survey->user_id = $category->user->id;
            $survey->category_id = $category->id;
            $survey->question_id = $question->id;
            $survey->answer_id = $answers_list[$list_index];
            
            $survey->save();

            $list_index++;
        }

        //Mark token as 'used' after successful survey creation
        $check_token->used = true;
        $check_token->save();

        return view('surveys.finish');
    }

    //Get Form where an email, to which a survey will be sent, is specified
    public function send(Category $category)
    {

        if ($category->user->id != auth()->user()->id) {
            return redirect('categories')->with('error', 'Unauthorized Page');
        }

        if (count($category->questions) == 0) {     
            
            return redirect('questions/create/' .$category->id)->with('error', 'please create questions first before sending the survey');
        }

        return view('surveys.sendForm', compact('category'));
    }

    public function sendlink(Category $category)
    {
        //Get individual email
        $email_string = request('emails');
        $pattern = ',';
        $emails_array = explode($pattern, $email_string);
        $emails_trimmed = array_map('trim', $emails_array);

        foreach ($emails_trimmed as $key => $email) {
    
            event(new ReadyToSendSurveyLinkEvent($category, $email));
                            
        }
        return redirect('categories')->with('success', 'Survey Links Sent ');
    }

}
