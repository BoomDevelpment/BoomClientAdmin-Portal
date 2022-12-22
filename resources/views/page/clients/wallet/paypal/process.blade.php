@extends('layouts.client')

@section('title', 'Boom Solutions - Wallet')

@section('content')

<div class="pcoded-wrapper">
	<div class="pcoded-content">
		<div class="pcoded-inner-content">
			<div class="main-body">
                
                <div class="page-wrapper">
                    <div class="page-body m-t-10">
                        
                        <br>

                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row m-b-10">
                                            <div class="col-lg-12 col-xl-12" style="text-align: center;">
                                                <img src="{{ asset('/src/images/paypal.png') }}" alt="" style="width: 500px;"><br>
                                            </div>
                                            <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 36px; font-family: inherit; color: #3b7bbf" >
                                                Transferencia Cancelada o Procesada.
                                            </div>
                                            <div class="col-xl-12 col-md-12" style="text-align: font-family: inherit;" >
                                                <div class="card-block">
                                                    <div class="row">
                                                        <div class="col-xl-12 col-md-12">
                                                            <a href="{{ url('/invoices') }}" class="btn btn-primary btn-block p-t-15 p-b-15" style="background: #3b7bbf; font-family:inherit;">
                                                               Ir Facturas
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

			</div>
		</div>
	</div>
</div>

@include('page.clients.wallet.paypal.modal')

@endsection

@section('js')

<script type="text/javascript">

$(function() 
{ 

});

</script>

@endsection