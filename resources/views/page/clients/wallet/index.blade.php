@extends('layouts.client')

@section('title', 'Boom Solutions - Wallet')

@section('content')

    @include('page.clients.wallet.body')

    @include('page.clients.wallet.modal')

@endsection

@section('js')

<script type="text/javascript">

function viewRegister(id, ty)
{
    var request = $.ajax({
        type:   'GET',
        url:    "{{url('/wallet/view')}}",
        data:   {id: id, ty:ty},
        headers:{
            'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 	'application/x-www-form-urlencoded'
        }
    });
    request.done(function(data)
    {
        ResetModal();
        $('#vSub').html(data.d.sub);
        $('#vDes').html(data.d.des);
        $('#vDate').html(data.d.date);
        $('#vRef').html(data.d.ref);
        $('#vToD').html('$ '+data.d.dol+'');
        $('#vToB').html('BS '+data.d.bs+'');
        $('#vSta').html(data.d.sta);
        $.each(data.f, function( i, d ) { 
            $("#vImg").append('<div class="col-lg-6 col-xl-3 col-md-6"><div class="img-hover"><img class="img-fluid img-radius" src="/'+d.dir_name+'/'+d.name+'" alt="round-img"><div class="img-overlay img-radius"><span><a href="#" class="btn btn-sm btn-primary" data-popup="lightbox"><i class="icofont icofont-plus"></i></a></span></div></div></div>'); 
        });
        $('#ViewTransModal').modal('show');
        
    })
    request.fail(function(response)
    {
        ResetModal();
        $("#vImg").html('');
    })
}

function ResetModal()
{
    $('#vSub').html('');$('#vDes').html('');$('#vDate').html('');$('#vRef').html('');
    $('#vToD').html('');$('#vToB').html('');$('#vSta').html('');$('#vImg').html('');
}

function ViewTrans(id)
{
    var request = $.ajax({
        type:   'GET',
        url:    "{{url('/wallet/view/all')}}",
        data:   {ty:id},
        headers:{
            'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 	'application/x-www-form-urlencoded'
        }
    });
    request.done(function(data)
    {
        if(id == 1){
            table   = 'tblZelle';
        $('#tblZelle tbody').empty('');
        }else if(id == 2){
            table   = 'tblPaypal';
            $('#tblPaypal tbody').empty('');
        }else if(id == 3){
            table   = 'tblBank';
            $('#tblBank tbody').empty('');
        }else if(id == 4){
            table   = 'tblMovil';
            $('#tblMovil tbody').empty('');
        }

        $.each(data.d, function( i, d ) {
            date = new Date(d.created);
            if(d.status != 3){ status = '<label class="label label-success">COMPROBADO</label>'}else{ status = '<label class="label label-danger">PENDIENTE</label>'; }
            $('#'+table+'').append('<tr><td>'+i+'</td><td>'+d.date_trans+'</td><td>'+d.reference+'</td><td>$ '+d.total+'</td><td>BS '+d.bs+'</td><td>'+status+'</td><td>'+date.toISOString().slice(0, 10)+'</td><td><a onClick="viewRegister('+d.id+', id);" class="btn btn-info btn-outline-info btn-mini">Ver</a></td></tr>'); 
        });

        
    })
    request.fail(function(response)
    {
        ResetModal();
        $("#vImg").html('');
    })
}

</script>

@endsection