@extends('layouts.client')

@section('title', 'Boom Solutions - Donatives')

@section('content')

    @include('page.clients.donatives.body')

    @include('page.clients.donatives.modal')

@endsection

@section('js')

<script type="text/javascript">

    $('.carousel-nav').owlCarousel({
        items:1,
        loop:true,
        autoplay:true,
        nav:true
    });

    $("#handleDonate").submit(function(e) 
    {      
        var to     =   $('#d_amou').val(); 
        if( (to <= 0.9) || (to == '') )
        {
            swal('Alerta!', 'Su donativo deber ser mayor o igual a $ 1.00');
        }else{

            var request = $.ajax({
                url:    '{{url('donate/register')}}',
                type:   'POST',
                data:   {to:to},
                headers:{
                    'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 	'application/x-www-form-urlencoded'
                }
            });
            request.done(function(data){
                swal("Donativo!",data.message);
                setTimeout( function() { window.location = data.url; }, 2500); 
            })
            request.fail(function(response)
            {
                swal("Alerta", JSON.parse(response.responseText).message);
                setTimeout( function() { window.location = data.url; }, 2500); 
            });
        }

        return false;
    });
</script>

@endsection