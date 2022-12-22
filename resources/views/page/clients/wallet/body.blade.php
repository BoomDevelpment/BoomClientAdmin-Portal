<div class="pcoded-wrapper">
	<div class="pcoded-content">
		<div class="pcoded-inner-content">
			<div class="main-body">
                
                <div class="page-wrapper">
                    <div class="page-body m-t-10">
                        <div class="row">
                            <div class="col-xl-12 col-md-12" style="text-align: center;font-size: 42px; font-family: fantasy; color: darkgray;" >
                                Balance
                            </div>
                            <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 18px; font-family: fantasy; color: lightgray;" >
                                <div id="salBCVWallet"> BCV {{ $divisa->dolar }} Bs</div>
                                <div id="salBCVDateWallet" style="text-align: center; font-size: 12px; font-family: fantasy; color: lightgray;"> {{ $divisa->created_at }}</div>
                            </div>
                            <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 72px; font-family: fantasy; color: green;" >
                                <div id="salUsdWallet"> $ {{ $wallet->balanceFloat }} </div>
                            </div>
                            <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                                <div id="salBsWallet"> {{ $bs }} Bs </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6 col-md-6" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                                <a href="{{ url('/invoices') }}" class="btn btn-primary btn-block p-t-15 p-b-15">
                                   Ir Facturas
                                </a>
                            </div>
                            <div class="col-xl-6 col-md-6" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                                <a href="{{ url('/wallet/register') }}" class="btn btn-primary btn-block p-t-15 p-b-15">
                                    Registrar Pagos
                                </a>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row m-b-10">
                                            <div class="col-lg-12 col-xl-12">
                                                <ul class="nav nav-tabs md-tabs" role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active" data-toggle="tab" href="#zelle" role="tab">Zelle</a>
                                                        <div class="slide"></div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#paypal" role="tab">Paypal</a>
                                                        <div class="slide"></div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#banks" role="tab">Transferecias Bancarias</a>
                                                        <div class="slide"></div>
                                                    </li>
                                                    <li class="nav-item">
                                                        <a class="nav-link" data-toggle="tab" href="#movil" role="tab">Pago Movil</a>
                                                        <div class="slide"></div>
                                                    </li>
                                                </ul>
                                                <!-- Tab panes -->
                                                <div class="tab-content card-block">
                                                    <div class="tab-pane active" id="zelle" role="tabpanel">
                                                        @include('page.clients.wallet.body.zelle')
                                                    </div>
                                                    <div class="tab-pane" id="paypal" role="tabpanel">
                                                        @include('page.clients.wallet.body.paypal')
                                                    </div>
                                                    <div class="tab-pane" id="banks" role="tabpanel">
                                                        @include('page.clients.wallet.body.bank')
                                                    </div>
                                                    <div class="tab-pane" id="movil" role="tabpanel">
                                                        @include('page.clients.wallet.body.movil')
                                                    </div>
                                                </div>
                                                <!-- End Tab panes -->
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