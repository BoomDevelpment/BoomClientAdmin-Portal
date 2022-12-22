@extends('layouts.client')

@section('title', 'Boom Solutions - Invoices')

@section('content')

    @include('page.clients.invoices.body')

    @include('page.clients.invoices.modal')

@endsection

@section('js')

<script type="text/javascript">

$(function() 
{ 
    
    let timeout;

    $("#billsList").change(function() {
        if($("#billsList").val() != '')
        {
            $('#mTrans').val('');
            var request = $.ajax({
                type:   'POST',
                url:    "{{url('/paypal/calculate')}}",
                data:   {id: $('#billsList').val(), ty:'i'},
                headers:{
                    'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 	'application/x-www-form-urlencoded'
                }
            });
            request.done(function(data)
            {
                RemovePPmodal();

                $('#vPpBill').val(data.d.tInv);
                $('#vPpTax').val(data.d.tCom);
                $('#vPpTotal').html('$ '+data.d.tAmo+'');
                
            })
            request.fail(function(response)
            {
                RemovePPmodal();
                $("#vPayPalError").html("<div class='alert alert-danger' style='margin-bottom: 0'>"+JSON.parse(response.responseText).message+"</div>");
            })
        }else{
            RemovePPmodal();
            $("#vPayPalError").html();
            $("#vPayPalError").html("<div class='alert alert-danger' style='margin-bottom: 0'>Debe seleccionar una factura v&aacute;lida</div>");
        }
    });

    $('#mTrans').keydown(function(){
        clearTimeout(timeout)
        timeout = setTimeout(() => {
            $('#billsList').val('');
            var request = $.ajax({
                type:   'POST',
                url:    "{{url('/paypal/calculate')}}",
                data:   {id: $('#mTrans').val(),ty:'c'},
                headers:{
                    'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                    'Content-Type': 	'application/x-www-form-urlencoded'
                }
            });
            request.done(function(data)
            {
                RemovePPmodal();

                $('#vPpBill').val(data.d.tInv);
                $('#vPpTax').val(data.d.tCom);
                $('#vPpTotal').html('$ '+data.d.tAmo+'');
                
            })
            request.fail(function(response)
            {
                RemovePPmodal();
                $("#vPayPalError").html("<div class='alert alert-danger' style='margin-bottom: 0'>"+JSON.parse(response.responseText).message+"</div>");
            })
            clearTimeout(timeout)
        },1000)
    });

});

function PPSubmit()
{
    if($("#billsList").val() != '')
    {

        var request = $.ajax({
            type:   'POST',
            url:    "{{url('/paypal/order')}}",
            data:   {id: $('#billsList').val()},
            headers:{
                'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
                'Content-Type': 	'application/x-www-form-urlencoded'
            }
        });
        request.done(function(data)
        {
            RemovePPmodal();

            $('#ViewPaypal').modal('hide');

            window.open(data.d.link, '_blank');
            
        })
        request.fail(function(response)
        {
            RemovePPmodal();
            $("#vPayPalError").html("<div class='alert alert-danger' style='margin-bottom: 0'>"+JSON.parse(response.responseText).message+"</div>");
        })
    }else{
        $("#vPayPalError").html();
        RemovePPmodal();
        $("#vPayPalError").html("<div class='alert alert-danger' style='margin-bottom: 0'>Debe seleccionar una factura V&aacute;lida</div>");
    }
}

function RemovePPmodal()
{
    $('#vPayPalError').html('');
    $('#vPpBill').val('Total Factura $0.00');
    $('#vPpTax').val('Total Impuesto $0.00');
    $('#vPpTotal').html('$ 0.00');
}

function Payment(id)
{
    $('#ViewInvoices').modal('show');

}

function PaypalModal()
{
    $('#ViewPaypal').modal('show');
}

</script>

@endsection