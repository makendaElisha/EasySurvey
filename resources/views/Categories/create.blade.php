@extends('layouts.app')

@section('content')
    <h1>Create Category</h1>

    <form action=" {{route('categories.store')}} " method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name"><strong>Name</strong></label>
            <input type="text" name="name" class="form-control" placeholder="Give a short title">
        </div>

        <div class="form-group">
            <label for="category"><strong>Description</strong></label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control" placeholder="Describe the survey to users"></textarea>
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>

@endsection