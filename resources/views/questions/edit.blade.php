@extends('layouts.app')

@section('content')
    <h1>Edit Question</h1>
    <p><strong>Category:</strong> {{$question->category->name}} </p>
    <form action=" {{route('questions.update', $question->id)}}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="name"><strong>Name</strong></label>
            <input type="text" name="name" value=" {{$question->name}} " class="form-control" placeholder="type the question">
        </div>
        
        <div class="form-group pl-3 " >
            <p><strong>Answers options</strong></p>

            @foreach ($question->answers as $answer)
            <input type="text" name="answers[]" value = " {{$answer->name}} " class="form-control" placeholder="Write an option">
            @endforeach

        </div>
        
        <div class="pt-4">
                <button type="submit" class="btn btn-success">Update</button>
        </div>

    </form>

@endsection