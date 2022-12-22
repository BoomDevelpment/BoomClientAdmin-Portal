<div class="card">
    <div class="card-header">
        <h1 style="text-align: center; color:lightblue; font-family: fantasy;">Registro de Transferencia Paypal</h1>
    </div>
    <div class="card-block">
        
        <form class="md-float-material form-material" id="handlePaypal" name="handlePaypal" >
            <div class="row m-b-20">
                <div class="col-sm-12 m-b-20">
                    <div id="errorPaypal"></div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Asunto</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="p_asu" id="p_asu" placeholder="T&iacute;tulo de asunto">
                                    <input type="text" name="p_ide" id="p_ide" hidden readonly>
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Fecha</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="p_date" id="p_date" placeholder="Fecha de la transferencia">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Total</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="p_total" id="p_total" placeholder="Total del monto transferido">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nº Referencia</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="p_reference" id="p_reference" placeholder="N&uacute;mero de referencia de transferencia">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Correo</label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="p_email" id="p_email" placeholder="Correo electr&oacute;nico de transferencia">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row m-t-20">
                <div class="col-sm-12">
                    <h4 class="sub-title">Mensaje</h4>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="input-group">
                                <textarea rows="5" cols="5" name="p_message" id="p_message" class="form-control" placeholder="Coloque aqu&iacute; un mensaje o informaci&oacute;n que desee agregar."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <form id="handlePaypalUpload" name="handlePaypalUpload" class="md-float-material form-material"  method="POST" action="javascript:void(0)" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title">Archivos Adjuntos</h4>
                    <div class="row m-b-20">
                        <div class="col-sm-12">
                            <div id="errorPaypalAdj"></div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-11">
                                    <input type="file" class="form-control" name="p_file" id="p_file" style="margin-bottom: 5px;">
                                    <input type="text" name="p_ide_f" id="p_ide_f" hidden readonly>
                                </div>
                                <label class="col-sm-1"><button type="submit" class="btn btn-success">Subir</button></label>
                            </div>
                            <div class="col-sm-12">
                                <div id="PaypalFiles"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-footer">
            <a class="btn btn-primary btn-block m-b-0" onclick="ConfirmPaypal();">Registrar Pago</a>
        </div>
    </div>
</div>