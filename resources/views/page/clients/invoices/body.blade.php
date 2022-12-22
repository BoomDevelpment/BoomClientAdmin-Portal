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
                                <a href="{{ url('/wallet') }}" class="btn btn-primary btn-block p-t-15 p-b-15">
                                   Ir Balance
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
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <h5>Listado de Facturacion</h5>

                                            </div>
                                            <div class="col-md-6" style="text-align: right;">

                                                <a onclick="PaypalModal();" class="paypal-buy-now-button">
                                                    <span>Transferir con  </span> 
                                                    <svg aria-label="PayPal" width="90" height="33" viewBox="34.417 0 90 33">
                                                       <path fill="#253B80" d="M46.211 6.749h-6.839a.95.95 0 0 0-.939.802l-2.766 17.537a.57.57 0 0 0 .564.658h3.265a.95.95 0 0 0 .939-.803l.746-4.73a.95.95 0 0 1 .938-.803h2.165c4.505 0 7.105-2.18 7.784-6.5.306-1.89.013-3.375-.872-4.415-.972-1.142-2.696-1.746-4.985-1.746zM47 13.154c-.374 2.454-2.249 2.454-4.062 2.454h-1.032l.724-4.583a.57.57 0 0 1 .563-.481h.473c1.235 0 2.4 0 3.002.704.359.42.469 1.044.332 1.906zM66.654 13.075h-3.275a.57.57 0 0 0-.563.481l-.146.916-.229-.332c-.709-1.029-2.29-1.373-3.868-1.373-3.619 0-6.71 2.741-7.312 6.586-.313 1.918.132 3.752 1.22 5.03.998 1.177 2.426 1.666 4.125 1.666 2.916 0 4.533-1.875 4.533-1.875l-.146.91a.57.57 0 0 0 .562.66h2.95a.95.95 0 0 0 .939-.804l1.77-11.208a.566.566 0 0 0-.56-.657zm-4.565 6.374c-.316 1.871-1.801 3.127-3.695 3.127-.951 0-1.711-.305-2.199-.883-.484-.574-.668-1.392-.514-2.301.295-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.499.589.697 1.411.554 2.317zM84.096 13.075h-3.291a.955.955 0 0 0-.787.417l-4.539 6.686-1.924-6.425a.953.953 0 0 0-.912-.678H69.41a.57.57 0 0 0-.541.754l3.625 10.638-3.408 4.811a.57.57 0 0 0 .465.9h3.287a.949.949 0 0 0 .781-.408l10.946-15.8a.57.57 0 0 0-.469-.895z"></path>
                                                       <path fill="#179BD7" d="M94.992 6.749h-6.84a.95.95 0 0 0-.938.802l-2.767 17.537a.57.57 0 0 0 .563.658h3.51a.665.665 0 0 0 .656-.563l.785-4.971a.95.95 0 0 1 .938-.803h2.164c4.506 0 7.105-2.18 7.785-6.5.307-1.89.012-3.375-.873-4.415-.971-1.141-2.694-1.745-4.983-1.745zm.789 6.405c-.373 2.454-2.248 2.454-4.063 2.454h-1.031l.726-4.583a.567.567 0 0 1 .562-.481h.474c1.233 0 2.399 0 3.002.704.358.42.467 1.044.33 1.906zM115.434 13.075h-3.272a.566.566 0 0 0-.562.481l-.146.916-.229-.332c-.709-1.029-2.289-1.373-3.867-1.373-3.619 0-6.709 2.741-7.312 6.586-.312 1.918.131 3.752 1.22 5.03 1 1.177 2.426 1.666 4.125 1.666 2.916 0 4.532-1.875 4.532-1.875l-.146.91a.57.57 0 0 0 .563.66h2.949a.95.95 0 0 0 .938-.804l1.771-11.208a.57.57 0 0 0-.564-.657zm-4.565 6.374c-.314 1.871-1.801 3.127-3.695 3.127-.949 0-1.711-.305-2.199-.883-.483-.574-.666-1.392-.514-2.301.297-1.855 1.805-3.152 3.67-3.152.93 0 1.686.309 2.184.892.501.589.699 1.411.554 2.317zM119.295 7.23l-2.807 17.858a.569.569 0 0 0 .562.658h2.822c.469 0 .866-.34.938-.803l2.769-17.536a.57.57 0 0 0-.562-.659h-3.16a.571.571 0 0 0-.562.482z"></path>
                                                    </svg>
                                                 </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-borderless" style="margin-bottom: 0px;">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th># Factura</th>
                                                        <th>Emitido</th>
                                                        <th>Vencimiento</th>
                                                        <th>Total</th>
                                                        <th>Total Bs</th>
                                                        <th>Estado</th>
                                                        <th>Fecha</th>
                                                        <th>Ver mas</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>2</td>
                                                        <td><a href="javascript:;" onclick="Payment(2);">00104498</a></td>
                                                        <td>2022-10-01</td>
                                                        <td>2022-12-01</td>
                                                        <td>$ 35.00</td>
                                                        <td>BS 290.50</td>
                                                        <td><label class="label label-danger">No Pagado</label></td>
                                                        <td>14/07/2022</td>
                                                        <td>
                                                            <a href="javascript:;" onclick="Payment(2);" class="btn btn-mini btn-grd-info"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2</td>
                                                        <td><a href="javascript:;" onclick="Payment(2);">00104498</a></td>
                                                        <td>2022-10-01</td>
                                                        <td>2022-12-01</td>
                                                        <td>$ 35.00</td>
                                                        <td>BS 290.50</td>
                                                        <td><label class="label label-danger">No Pagado</label></td>
                                                        <td>14/07/2022</td>
                                                        <td>
                                                            <a onclick="Payment(2);" class="btn btn-mini btn-grd-info"><i class="fa fa-eye"></i></a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <div class="text-right m-r-20">
                                                <a href="#!" class=" b-b-primary text-primary">Ver todas las facturas</a>
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