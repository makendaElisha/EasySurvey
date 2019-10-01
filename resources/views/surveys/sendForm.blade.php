@extends('layouts.app')

@section('content')

<h2>Send Survey</h2>

<p><strong>Title: </strong> {{$category->name}} </p>

<div class="row">
    <div class="col">
        <form action={{route('survey.sendlink', $category->id)}} method="post">
            @csrf
            <div class="form-group">
                <label for="email">Emails</label>
                <textarea name="emails" id="emails" cols="20" rows="10" class="form-control"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Send survey</button>
        
        </form>
    </div>
     
    <div class="col pt-5">
        <ul style="list-style-square">
            <li>Enter one or many emails separated by commas ( , )</li>
            <li>Each email will receive a unique link to survey</li>
            <li>Emails must be in correct format</li>
            (eg. first@test.com,second@test.com,third@test.com")
        </ul>
        
    </div>
</div>

@endsection