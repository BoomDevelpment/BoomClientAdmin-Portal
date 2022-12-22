@extends('layouts.client')

@section('title', 'Boom Solutions - Tickets')

@section('content')

    @include('page.clients.vouchers.body')

    @include('page.clients.vouchers.modal')

@endsection

@section('js')

<script type="text/javascript">
    $('.carousel-nav').owlCarousel({
        items:1,
        loop:true,
        autoplay:true,
        nav:true
    });

    $("#handleTicket").submit(function(e) 
    {
        
        var id = $('#t_id').val();

        var request = $.ajax({
            url:    '{{url('tickets/change')}}',
            type:   'POST',
            data:   {id:id, ty:2},
            headers:{
                'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 	'application/x-www-form-urlencoded'
            }
        });
        request.done(function(data){
            swal("Success!", "Ticket Procesado correctamente");
            setTimeout( function() { window.location = data.url; }, 2500); 
        })
        request.fail(function(response)
        {
            swal("Error!", JSON.parse(response.responseText).message);
            setTimeout( function() { window.location = data.url; }, 2500); 
        });
        return false;
    });

    function ChangeTicket(id)
    {
        var e = this;
        var request = $.ajax({
            url:    '{{url('tickets/change')}}',
            type:   'POST',
            data:   {id:id, ty:1},
            headers:{
                'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 	'application/x-www-form-urlencoded'
            }
        });
        request.done(function(data){
            swal("Success!", "Ticket Procesado correctamente");
            setTimeout( function() { window.location = data.url; }, 2500); 
        })
        request.fail(function(response)
        {
            swal("Error!", JSON.parse(response.responseText).message);
            setTimeout( function() { window.location = data.url; }, 2500); 

        });
        return false;
    }
</script>

@endsection