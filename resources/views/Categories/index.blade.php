@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h5 class="card-title" style="display:inline">Categories</h5>
                        <a href=" {{route('categories.create')}} " class="btn btn-primary" style="float: right">Create</a>
                </div>
                
            </div>
        </div>
    </div>
</div>

@if(count($categories) == 0)
<h4>You don't have any Surveys .</h4>

@else
<div class="row">
@foreach ($categories as $category)
 
<div class="col-sm-6 py-3">
    <div class="card">
    <div class="card-body">
        <div> <h4 class="card-title">{{$category->name}} </h4>  
        </div>

        <p class="card-text">It's a broader card with text below as a natural lead-in to extra content. This content is a little longer.</p>
        <a href=" {{route('categories.show', $category->id)}}" class="btn btn-primary btn-sm">Questions</a>
        <a href=" {{route('survey.send', $category->id)}}" class="btn btn-primary btn-sm">Share Survey link</a>
        <a href=" {{route('categories.edit', $category->id)}}">Edit</a>
        <div class="float-right">
            <form onsubmit="return confirm('Do you really want to delete this Survey?');" action="{{route('categories.destroy', [$category->id])}}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm ">Delete</button>
            </form>
        </div>
    </div>
    </div>
</div>
@endforeach
</div>


@endif                    


@endsection