@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Categories</div>

                <div class="card-body">
                    
                    @if (count($categories) == 0)
                    <p>Nothing To display</p>
                    
                    @else
                    @foreach ($categories as $key => $category)
                        <div class="row">
                            <div class="col">
                                {{$key + 1}}. {{$category->name}}
                            </div>
                            
                            <div class="col">
                            <a href=" {{route('results.show', $category->id)}}">Show results</a>
                            </div>
                        </div>
                    @endforeach

                    @endif
                    

                </div>
            </div>
        </div>
    </div>
</div>


@endsection