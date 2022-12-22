<div class="modal fade" id="ConfirmModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmaci&oacute;n de Pagos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background: aliceblue;">
                <div class="row">
                    <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 18px; font-family: fantasy;" >
                        <h5>Desea procesar el siguiente pago</h5>
                    </div>
                    <input type="text" id="mType" name="mType" hidden readonly>
                    <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 18px; font-family: fantasy; color: lightgray;" >
                        <div id="mBCV"></div>
                    </div>
                    <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 72px; font-family: fantasy; color: green;" >
                        <div id="mUSD"></div>
                    </div>
                    <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                        <div id="mBS"></div>
                    </div>
                    <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                        <div id="mError"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary btn-block m-b-0" onclick="ProcessPayment();">Registrar Pago</a>
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="ConfirmPaypalModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="md-content">
                    <h3 style="text-align: center; font-size: 36px; font-family: fangsong;">Datos de Transferencia</h3>
                    <form id="handlePaypal" name="handlePaypal"">
                        <div class="row">
                            <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                                <div id="pError"></div>
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <div class="row">
                                <div class="col md-6" style="text-align: center">
                                    <label for="">Monto </label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-cur-dollar"></i></span>
                                        <input type="text" style="text-align: center;" class="form-control pamount" id="iPUSD" name="iPUSD" placeholder="Total Factura" readonly value="0.00">
                                    </div>
                                </div>
                                <div class="col md-6" style="text-align: center">
                                    <label for="">Paypal Fee</label>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-cur-dollar"></i></span>
                                        <input type="text" style="text-align: center;" class="form-control pname" id="cPUSD" name="cPUSD" placeholder="Paypal Fee" readonly value="0.00">
                                    </div>
                                </div>
                            </div>
                            <div class="input-group" style="margin-bottom: 0px;">
                                <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 24px; font-family: fangsong;">
                                    Total a Transferir
                                </div>
                            </div>
                            <div class="input-group">
                                <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 72px; font-family: fantasy; color: green;" >
                                    <div id="aPUSD" name="aPUSD"> $0.00 </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <a class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn" style="color:white;" onclick="ProcessPaypal();">Procesar</a>
                                <button type="button" data-dismiss="modal" class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>