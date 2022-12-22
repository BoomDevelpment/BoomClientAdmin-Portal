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
                                                Transferencia realizada satisfactoriamente
                                            </div>
                                            <div class="col-xl-12 col-md-12" style="text-align: font-family: inherit;" >
                                                <div class="card-block">
                                                    <div class="row invoive-info">
                                                        <div class="col-md-4 col-xs-6 invoice-client-info" style="text-align: font-family: inherit;">
                                                            <h6 class="m-0">{{ $u->name }}</h6>
                                                            <p class="m-0 m-t-10">{{ $d['paypal_email'] }}</p>
                                                        </div>
                                                        <div class="col-md-4 col-xs-6 invoice-client-info">
                                                            <h6 class="m-0">BOOM SOLUTIONS</h6>
                                                            <p class="m-0 m-t-10">Planta alta, Centro Comercial Churun Meru, Av Lara, Barquisimeto 3001, Lara</p>
                                                        </div>
                                                        <div class="col-md-4 col-xs-6 invoice-client-info">
                                                            <h6 class="m-0">Factura: #{{ $d['invoice_id'] }}</h6>
                                                            <p class="m-0 m-t-10">Referencia: #{{ $d['orderID'] }}</p>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table class="table table-responsive invoice-table invoice-total">
                                                                <tbody>
                                                                    <tr><th>Sub Total :</th><td>$ {{ $d['gross_amount'] }}</td></tr>
                                                                    <tr><th>Fee :</th><td>$ {{ $d['paypal_fee'] }}</td></tr>
                                                                    <tr class="text-info" style="color: #3b7bbf;">
                                                                        <td><hr><h5 style="color: #3b7bbf;">Total :</h5></td>
                                                                        <td><hr><h5 style="color: #3b7bbf;">$ {{ $d['net_amount'] }}</h5></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
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