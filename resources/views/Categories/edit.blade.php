@extends('layouts.app')

@section('content')
    <h1>Edit Category</h1>
    <form action=" {{route('categories.update', $category->id)}}" method="POST">
        @csrf
        @method('PATCH')
        
        <div class="form-group">
            <label for="name"><strong>Title</strong></label>
            <input type="text" name="name" value=" {{$category->name}} " class="form-control" placeholder="Enter the Title">
        </div>
       
        <div class="form-group">
            <label for="category"><strong>Description</strong></label>
            <textarea name="description" id="" cols="30" rows="10" class="form-control"> {{$category->description}} </textarea>
        </div>
        
        <div class="pt-4">
                <button type="submit" class="btn btn-success">Update</button>
        </div>

    </form>

@endsection