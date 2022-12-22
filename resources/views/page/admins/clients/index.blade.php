@extends('layouts.admin')

@section('title', 'Boom Solutions')

@section('content')

<div id="content" class="content">

    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Clients</a></li>
    </ol>

    @include('page.admins.clients.body')
    
    @include('page.admins.clients.modal')
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