@extends('layouts.client')

@section('title', 'Boom Solutions - Notification')

@section('content')

    @include('page.clients.customers.body')

    @include('page.clients.customers.modal')

@endsection

@section('js')

<script type="text/javascript">

$('.carousel-nav').owlCarousel({
    items:1,
    loop:true,
    autoplay:true,
    nav:true
});

$('#simpletable').DataTable({
    "order": [
        [3, "desc"]
    ]
});

$(document).ready(function(){
    $('form[name="handleInvoice"]').submit( function(event){
        $('#pFiels').empty();
        $('#NotInvoice').modal('show');
        return false;
    } );
    $('form[name="handleSupport"]').submit( function(event){ 
        $('#mFiels').empty();
        $('#NotSupport').modal('show');
        return false;
    } );
    $('form[name="handleRecInvoice"]').submit( function(event){ 

        if($('#R').val() == '')
        {
            $('#pFiels').empty();
            $("#sfError").html("<div class='alert alert-danger' style='margin-bottom: 0'>Debe seleccionar una opci&oacute;n v&aacute;lida.</div>");
        }else
        {
            var request = $.ajax({
                type:   'POST',
                url:    "{{url('/customers/register')}}",
                data:   $('#handleRecInvoice').serialize(), 
                headers:{
                    'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 	'application/x-www-form-urlencoded'
                }
            });
            request.done(function(data)
            {
                $('#handleRecInvoice')[0].reset();
                $('#NotInvoice').modal('hide');
                $('#R').val('');
                swal("Success!", data.message);
                setTimeout( function() { window.location = data.url; }, 2500);   
                
            })
            request.fail(function(response)
            {
                if(JSON.parse(response.responseText).message == '')
                {
                    $('#R').val(''); 
                    $('#pFiels').empty();   
                }else{
                    $('#R').val('');
                    $("#sfError").html("<div class='alert alert-danger' style='margin-bottom: 0'>"+JSON.parse(response.responseText).message+"</div>");
                }
            })
        }
        return false;
    } );

    $('form[name="handleRecSupport"]').submit( function(event){ 

        if($('#M').val() == '')
        {
            $('#M').val('');
            $('#mFiels').empty();
            $("#hrsError").html("<div class='alert alert-danger' style='margin-bottom: 0'>Seleccione una opci&oacute;n v&aacute;lida</div>");
        }else{

            $("#hrsError").html("<div class='alert alert-alert' style='margin-bottom: 0'>Procesando, Por favor espere!</div>");

            var request = $.ajax({
                type:   'POST',
                url:    "{{url('/customers/register')}}",
                data:   $('#handleRecSupport').serialize(), 
                headers:{
                    'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 	'application/x-www-form-urlencoded'
                }
            });
            request.done(function(data)
            {
                $('#handleRecSupport')[0].reset();
                $('#NotSupport').modal('hide');
                $('#M').val('');
                swal("Success!", data.message);
                setTimeout( function() { window.location = data.url; }, 2500);   
                
            })
            request.fail(function(response)
            {
                if(JSON.parse(response.responseText).message == '')
                {                   
                    $('#M').val(''); 
                    $('#mFiels').empty(); 
                    $("#hrsError").html("");                   
                }else{
                    $('#M').val('');
                    $("#hrsError").html("<div class='alert alert-danger' style='margin-bottom: 0'>"+JSON.parse(response.responseText).message+"</div>");

                }
            })
        }
        return false;
    } );
});

$( "#R" ).change(function() {
    $("#sfError").html("");

    if($('#R').val() == '')
    {
        $('#R').val('');
        $('#pFiels').empty();
        $("#sfError").html("<div class='alert alert-danger' style='margin-bottom: 0'>Seleccione una opci&oacute;n v&aacute;lida</div>");
    }else{        
        var request = $.ajax({
            type:   'POST',
            url:    "{{url('/customers/info')}}",
            data:   {id: $('#R').val()}, 
            headers:{
                'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 	'application/x-www-form-urlencoded'
            }
        });
        request.done(function(data)
        {
            $('#pFiels').empty();
            $('#pFiels').append(data.html);
            
        })
        request.fail(function(response)
        {
            $('#M').val('');
            $('#pFiels').empty();
            $("#sfError").html("<div class='alert alert-danger' style='margin-bottom: 0'>"+JSON.parse(response.responseText).message+"</div>");
        })
    }
});

$("#M").change(function() 
{

    $("#hrsError").html("");

    if($('#M').val() == '')
    {
        $('#M').val('');
        $('#mFiels').empty();
        $("#hrsError").html("<div class='alert alert-danger' style='margin-bottom: 0'>Seleccione una opci&oacute;n v&aacute;lida</div>");
    }else{        
        var request = $.ajax({
            type:   'POST',
            url:    "{{url('/customers/info')}}",
            data:   {id: $('#M').val()}, 
            headers:{
                'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 	'application/x-www-form-urlencoded'
            }
        });
        request.done(function(data)
        {
            $('#mFiels').empty();
            $('#mFiels').append(data.html);
            
        })
        request.fail(function(response)
        {
            $('#M').val('');
            $('#mFiels').empty();
            $("#hrsError").html("<div class='alert alert-danger' style='margin-bottom: 0'>"+JSON.parse(response.responseText).message+"</div>");
        })
    }
    return false;
});



</script>

@endsection