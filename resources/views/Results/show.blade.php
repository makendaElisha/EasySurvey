@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Survey for: <strong>{{$category->name}}</strong>
                    <span style="float:right; color:#FF7F50">
                        @if (count($category->questions) == 0)
                        <strong>0</strong> Participants
                        @else
                        <strong> {{($surveys->where('category_id', $category->id)->count()) / count($category->questions)}}</strong>
                        Participants
                        @endif
                          
                    </span>
                </div>

                <div class="card-body">
                    <u style="text-underlign">Questions</u>

                    @foreach ($category->questions as $key => $question)
                    
                        <div class="pt-3" >
                           <h5 class="card-title"> {{$key + 1}}. {{ $question->name }}</h5>
                        </div>

                        <ul>
                            @foreach ($question->answers as $answer)
                            <li style="list-style-type:square;">
                                <div>
                                        <p class="card-text">
                                            {{$answer->name}}:<strong style="color:#FF7F50"> <u> {{$surveys
                                                    ->where('answer_id', $answer->id)
                                                    ->where('question_id',$answer->question->id)
                                                    ->where('category_id', $answer->question->category->id)
                                                    ->where('user_id', $answer->question->category->user->id)
                                                    ->count()}} </u>
                                                </strong>
                                    
                                        </p>
        
                                    </div>
                            
                            </li>    
                            @endforeach

                        </ul>
                    @endforeach
                    

                </div>
            </div>
        </div>
    </div>
</div>
    

@endsection