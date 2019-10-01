@extends('layouts.app')

@section('content')

    <h1>New Question</h1>

    <p><strong>Category:</strong> {{$category->name}} </p>
    <form action=" {{route('questions.store')}} " method="POST">
        @csrf
        
        <div class="form-group">
            <label for="name"><strong>Name</strong></label>
            <input type="text" name="name" class="form-control" placeholder="type the question">
        </div>
        
        <div class="form-group pl-3" >
            <p><strong>Answers options</strong> (4 max)</p>

                
            <div class="input_wrap">
                <div>
                    <input type="text" name="answers[]" class="form-control" placeholder="Write an option"/>
                    <a href="javascript:void(0);" title="Add field" class="add_button" >Add</a>
                </div>
            </div>
            
        </div>

               
        <input type="hidden" name="category_id" value=" {{$category->id}} " >

        <div class="pt-4">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>

    </form>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            var fieldMax = 4; 
            var buttonAdd = $('.add_button'); 
            var wrapper = $('.input_wrap');
            var htmlInput = '<div><input type="text" name="answers[]" class="form-control" placeholder="Write an option"/><a href="javascript:void(0);" class="remove_button" style="color:red">Del</a></div>'; 
            var fieldCount = 1; 
        
        $(buttonAdd).click(function(){
            if(fieldCount < fieldMax){ 
                fieldCount++; 
                $(wrapper).append(htmlInput);            
                }
        });
        
        $(wrapper).on('click', '.remove_button', function(e){
            e.preventDefault();
            $(this).parent('div').remove(); 
            fieldCount--; 
        });
    });
    </script>
    
@endsection
