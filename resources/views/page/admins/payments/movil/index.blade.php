@extends('layouts.admin')

@section('title', 'Boom Solutions')

@section('content')

<div id="content" class="content">

    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Pago Movil</a></li>
    </ol>

    @include('page.admins.payments.movil.body')
    
    @include('page.admins.payments.movil.modal')

</div>

@endsection

@section('js')

<script type="text/javascript">

/****************************************************************************************************/

$(document).ready(function() {

});

/****************************************************************************************************/

</script>

@endsection