<div class="modal fade" id="ViewInvoices" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body" style="background: aliceblue; padding: 0px;">
                    <div class="row m-t-10">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6" style="text-align: center;">
                                    <img class="m-b-10" style="width: 200px;" src="{{ asset('src/icon/logicon.png') }}" alt="" />
                                </div>
                                <div class="col-sm-6 col-md-6 col-lg-6 col-xs-6 invoice-client-info" style="text-align: right">
                                    <strong style="margin-right: 10px;">COMPROBANTE DE PAGO: #00104498</strong><br /> 
                                    Fecha Emision: <strong style="margin-right: 10px;">01/10/2022</strong><br /> 
                                    Fecha Vencimiento: <strong style="margin-right: 10px;">01/10/2022</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-block">
                        <div class="row invoive-info">
                            <div class="col-md-6 col-xs-12 invoice-client-info" style="font-size: 12px;">
                                <strong>BOOM SOLUTIONS C.A</strong><br /> 
                                RIF: <strong>J-40537521-3</strong><br /> 
                                Av. Lara, C.C Churun Meru, Nivel S&oacute;tano Local S-1<br /> 
                                Barquisimeto, Lara, 003001 <br />
                                Tel&eacute;fono 0251-3353330 <br />
                            </div>
                            <div class="col-md-6 col-xs-12 invoice-client-info" style="font-size: 12px;">
                                <strong>PRUEBA DEMO</strong><br /> 
                                CED: <strong>123456789</strong><br /> 
                                Av. Lara, C.C Churun Meru, Nivel S&oacute;tano Local S-1<br /> 
                                Barquisimeto, Lara, 003001 <br />
                                Tel&eacute;fono 0251-3353330 <br />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table invoice-detail-table" style="font-size: 10px;">
                                        <thead>
                                            <tr class="thead-default">
                                                <th style="width: 60%">Description</th>
                                                <th style="width: 10%">Quantity</th>
                                                <th style="width: 10%">Amount</th>
                                                <th style="width: 10%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="margin-bottom: 0px;">
                                                    <p>lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                                                </td>
                                                <td>6</td>
                                                <td>$200.00</td>
                                                <td>$1200.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                                                </td>
                                                <td>7</td>
                                                <td>$100.00</td>
                                                <td>$700.00</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p>lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt </p>
                                                </td>
                                                <td>5</td>
                                                <td>$150.00</td>
                                                <td>$750.00</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-responsive invoice-table invoice-total" style="padding: 10px; background: none;">
                                    <tbody>
                                        <tr>
                                            <th>Sub Total :</th>
                                            <td>$4725.00</td>
                                        </tr>
                                        <tr>
                                            <th>Taxes (10%) :</th>
                                            <td>$57.00</td>
                                        </tr>
                                        <tr>
                                            <th>Discount (5%) :</th>
                                            <td>$45.00</td>
                                        </tr>
                                        <tr class="text-info">
                                            <td>
                                                <hr>
                                                <h5 class="text-primary">Total :</h5>
                                            </td>
                                            <td>
                                                <hr>
                                                <h5 class="text-primary">$4827.00</h5>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ViewPaypal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="md-content">
                    <h3 style="text-align: center; font-size: 36px; font-family: fangsong;">Transferencia Paypal</h3>
                    <form id="handlePaypal" name="handlePaypal"">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div id="vPayPalError"></div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col md-6" style="text-align: center">
                                <label for="">Seleccione una Factura</label>
                                <div class="input-group">
                                    <select id="billsList" name="billsList" class="form-control stock">
                                        <option value="" selected>Seleccione una Factura</option>
                                        @foreach($order as $ord)
                                            <option value="{{ $ord['id'] }}">Order id: {{ $ord['id'] }} - Amount: {{ $ord['amount'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col md-6" style="text-align: center">
                                <label for="">Monto de Factura</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icofont icofont-cur-dollar"></i></span>
                                    <input type="text" style="text-align: center;" class="form-control pname" id="mTrans" name="mTrans" placeholder="Monto a Transferir">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col md-6" style="text-align: center">
                                <label for="">Monto</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icofont icofont-cur-dollar"></i></span>
                                    <input type="text" style="text-align: center;" class="form-control pamount" id="vPpBill" name="vPpBill" placeholder="Total a Transferir" readonly value="0.00">
                                </div>
                            </div>
                            <div class="col md-6" style="text-align: center">
                                <label for="">Paypal Fee</label>
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="icofont icofont-cur-dollar"></i></span>
                                    <input type="text" style="text-align: center;" class="form-control pname" id="vPpTax" name="vPpTax" placeholder="Paypal Fee" readonly value="0.00">
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: 10px;">
                            <div class="input-group" style="margin-bottom: 0px;">
                                <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 24px; font-family: fangsong;">
                                    Total a Transferir
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 72px; font-family: fantasy; color: green;" >
                                    <div id="vPpTotal" name="vPpTotal"> $0.00 </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <a class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn" style="color:white;" onclick="PPSubmit();">Procesar</a>
                                <button type="button" data-dismiss="modal" class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>