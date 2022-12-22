<div class="card">
    <div class="card-header">
        <h1 style="text-align: center; color:lightblue; font-family: fantasy;">Registro de Transferencia Zelle</h1>
    </div>
    <div class="card-block">
        
        <form class="md-float-material form-material" id="handleZelle" name="handleZelle" >
            <div class="row m-b-20">
                <div class="col-sm-12 m-b-20">
                    <div id="errorZelle"></div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Asunto</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="zl_r_asu" id="zl_r_asu" placeholder="T&iacute;tulo de registro">
                                    <input type="text" name="zl_r_ide" id="zl_r_ide" hidden readonly>
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
                                    <input type="text" class="form-control" name="zl_r_date" id="zl_r_date" placeholder="Fecha de la transferencia">
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
                                    <input type="number" class="form-control" name="zl_r_amount" id="zl_r_amount" placeholder="Total del monto transferido">
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
                                <label class="col-sm-3 col-form-label">Titular</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="zl_r_titular" id="zl_r_titular" placeholder="Titular de la Transferencia">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nº Referencia</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="zl_r_reference" id="zl_r_reference" placeholder="N&uacute;mero de referencia de transferencia">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
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
                                <textarea rows="5" cols="5" name="zl_r_message" id="zl_r_message" class="form-control" placeholder="Coloque aqu&iacute; un mensaje o informaci&oacute;n que desee agregar."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <form id="handleZelleUpload" name="handleZelleUpload" class="md-float-material form-material"  method="POST" action="javascript:void(0)" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title">Archivos Adjuntos</h4>
                    <div class="row m-b-20">
                        <div class="col-sm-12">
                            <div id="errorZelleAdj"></div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-11">
                                    <input type="file" class="form-control" name="file" id="file" style="margin-bottom: 5px;">
                                    <input type="text" name="zl_r_ide_f" id="zl_r_ide_f" hidden readonly>
                                </div>
                                <label class="col-sm-1"><button type="submit" class="btn btn-success">Subir</button></label>
                            </div>
                            <div class="col-sm-12">
                                <div id="zelleFiles"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-footer">
            <a class="btn btn-primary btn-block m-b-0" onclick="RegisterZelle();">Registrar Pago</a>
        </div>
    </div>
</div>