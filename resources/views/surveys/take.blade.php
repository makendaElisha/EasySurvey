<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Survey</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div class="container pt-3">
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            Error. You must answer to every question before you submit.
        </div>
    @endif        

    </div>


<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><strong>Survey</strong>: {{$category->name}}</div>

                <div class="card-body">

                    <h4 style="color:blue">Hey there! welcome to our survey</h4>
                    <div style="color:red">(Import: You can only submit this survey once.)</div>
                    <div class="py-2"><strong>Description:</strong></div>
                    <div class="pb-2">{{$category->description}}</div>
                    
                    <form action=" {{route('survey.store', ['category' => $category->id, 'token' => $token->id])}} " method="post">
                        @csrf
                    
                        @foreach ($category->questions as $key => $question)
                        
                        <div class="pb-3">
                            <h5> {{$key + 1}}. {{$question->name}} </h5>
                            @foreach ($question->answers as $key => $answer)
                            <div>
                             <label><input type="radio" name="radio[{{$question->id}}]" id="radio" value="{{$answer->id}}">
                                {{$answer->name}}
                            </label>
                            </div>
                            @endforeach
            
                        </div>
                        @endforeach
                        
                        <div class="pt-3">
                            <button type="submit" class="btn btn-primary">Submit survey</button>
                        </div>
                    
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
