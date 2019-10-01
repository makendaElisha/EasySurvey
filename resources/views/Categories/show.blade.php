@extends('layouts.app')

@section('content')

<div class="container">
<h1>Survey: {{$category->name}}</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Questions
                <a href="{{route('questions.create', $category->id)}} " class="btn btn-primary" style="float: right">New Question</a>
            </div>
                <div class="card-body">
                        @if (count($category->questions) == 0)
                        <p>You don't have any questions!</p>
                    @else
                    
                    <div class="row">
                        <div class="col" >
                            
                            @foreach ($category->questions as $key => $question)
                                <div class="pt-3">
                                    <h5>{{$key + 1}}. {{$question->name}}</h5>
                                    <ul>
                                        @foreach ($question->answers as $answer)
                                            <li>
                                                {{$answer->name}}
                                                
                                            </li>
                                        @endforeach
                                        <a href=" {{route('questions.edit', $question->id)}}" style="display:inline">Edit /</a >
                                        
                                        <form onsubmit="return confirm('Do you want to delete this question?');" action=" {{route('questions.destroy', $question->id)}}" method="POST" style="display:inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
                                        </form>
                        
                                    </ul>

                                </div>
                    
                            @endforeach
                        </div>
                              
                            
                    </div>
                    
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>


@endsection
