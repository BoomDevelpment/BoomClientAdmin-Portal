@extends('layouts.encuesta')

@section('title', 'Boom Solutions - Encuesta de Satisfacci&oacute;n')

@section('content')

    @include('page.clients.survey.body')

    @include('page.clients.survey.modal')

@endsection

@section('js')

<script type="text/javascript">

$(document).ready(function(){
    $('form[name="handleSurvey"]').submit( function(event){
        var request = $.ajax({
            type:   'POST',
            url:    "{{url('/encuesta/register')}}",
            data:   $('#handleSurvey').serialize(), 
            headers:{
                'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 	'application/x-www-form-urlencoded'
            }
        });
        request.done(function(data)
        {
            $('#handleSurvey')[0].reset();
            swal("Success!", data.message);
            setTimeout( function() { window.location = data.url; }, 2500);   
            
        })
        request.fail(function(response)
        {
            swal("Alerta!", JSON.parse(response.responseText).message);
        })
        return false;
    } );
});

</script>
@endsection