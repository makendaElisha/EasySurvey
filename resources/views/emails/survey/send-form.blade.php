@component('mail::message')
<h2>Survey with title: {{$token->category->name}} </h2>

Good day, 

Kindly use the link below to participate to the survey.

{{url('/')}}/survey/take/{{$token->category->id}}/{{$token->id}}    

Notice: You can only take the survey once! After submission
the link cannot be reused. 

Thank you,
Have a good one!


@endcomponent
