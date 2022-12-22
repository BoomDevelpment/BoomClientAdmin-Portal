@extends('layouts.client')

@section('title', 'Boom Solutions - Test')

@section('content')

    @include('page.clients.dashboard.body')

    @include('page.clients.dashboard.modal')

@endsection

@section('js')

<script type="text/javascript">
    $('#dashModal').modal('show');
</script>

@endsection