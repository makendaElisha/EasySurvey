<?php

namespace App\Http\Controllers;

use App\Category;
use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('questions.create', compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Validation
        $this->validate($request, [
            'name' => 'required',
            'answers' => 'required|array|min:2',
        ]);
        

        //Save question
        $category = Category::find($request->category_id);
        $question = $category->questions()->create([
            'name' => $request->name,
        ]);

        //Save answers
        foreach ($request->answers as $answer) {
            $question->answers()->create([
                'name' => $answer,
            ]);
        }
        
        return redirect('categories/' . $category->id)->with('success', 'Question Created');
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Question $question)
    {
        //Deny unauthorized users
        if ($question->category->user->id != auth()->user()->id) {
            return redirect('categories')->with('error', 'Unauthorized Page');
        }

        return view('questions.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question)
    {
        //Validation
        request()->validate([
            'name' => 'required',
            'answers' => 'required',
        ]);

        //Update question
        $question->name = request('name');
        
        //Put answers from form into an array 
        $count_answers = count(request('answers'));
        $answers_list = [];
        $list_index = 0;
        
        foreach (request('answers') as $answer) {
            $answers_list[$list_index] = $answer;
            $list_index++;
        }

        //Assign new answers values of the question
        for ($i=0; $i < $count_answers; $i++) {
            
            if ($i == 0) {
                $question->answers->first()->name = $answers_list[$i];
            
            }elseif ($i > 0) {
                $question->answers()->skip($i)->first()->update(['name'=>$answers_list[$i]]);
            }
                        
        }

        //Save answers
        $question->push();     

        return redirect('categories/' .$question->category->id)->with('success', 'Question Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question)
    {   
        //Delete related answers first than delete question        
        $category_id = $question->category->id;
        $question->answers()->delete();
        $question->delete();

        return redirect('categories/' .$category_id);
    }
}

