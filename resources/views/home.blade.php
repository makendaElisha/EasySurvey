@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p> Welcome, {{auth()->user()->name}} </p>

                    <strong>Easily create and send your Surveys in 3 steps</strong>

                    <div class="card-body">
                        <h5 class="card-title">Step 1:</h5>
                        <h6 class="card-subtitle mb-2 text-muted">Create a category</h6>
                        <p class="card-text">Name your category and describe it for your participants</p>
                    </div>
                    <div class="card-body">
                            <h5 class="card-title">Step 2:</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Add questions</h6>
                            <p class="card-text">Create your muliple choice questions here </p>
                        </div>
                        <div class="card-body">
                                <h5 class="card-title">Step 3:</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Share your survey</h6>
                                <p class="card-text">click share link to send the survey to as many participants as you want</p>
                            </div>
                            <div style="text-align:center" class="pb-5">
                                <a href="{{route('categories.index')}}" class="btn btn-success">Create Survey</a> 
                                
                            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
