<div class="card">
    <div class="card-header">
        <h1 style="text-align: center; color:lightblue; font-family: fantasy;">Registro de Transferencia Bancaria</h1>
        <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 42px; font-family: fantasy; color: green;" >
            <div id="salBCVWallet"> BCV {{ $divisa->dolar }} Bs</div>
            <div id="salBCVDateWallet" style="text-align: center; font-size: 18px; font-family: fantasy; color: lightgray;"> {{ $divisa->created_at }}</div>
        </div>
    </div>
    <div class="card-block">
        
        <form class="md-float-material form-material" id="handleTransference" name="handleTransference" >
            <div class="row m-b-20">
                <div class="col-sm-12 m-b-20">
                    <div id="errorTransference"></div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Asunto</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="t_asu" id="t_asu" placeholder="T&iacute;tulo de Transferencia">
                                    <input type="number" name="t_ide" id="t_ide" hidden readonly>
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Titular</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="t_title" id="t_title" placeholder="Nombre del titular de la cuenta">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Cuenta</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="t_account" id="t_account" placeholder="Introduzca los n&uacute;meros de cuenta">
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
                                    <input type="number" class="form-control" name="t_total" id="t_total" placeholder="Total del monto transferido">
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
                                <label class="col-sm-3 col-form-label">Fecha</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="t_date" id="t_date" placeholder="Fecha de la transferencia">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">C&eacute;dula o Rif</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="t_dni" id="t_dni" placeholder="Introduzca la C&eacute;dula o Rif">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Banco</label>
                                <div class="col-sm-9">
                                    <select name="t_bank" id="t_bank" class="form-control">
                                        @foreach($bank as $bk)
                                            @if ($bk->status_id == 1)
                                                <option value="{{ $bk->id }}"> {{ $bk->name }}</option>                                                
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Referencia</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="t_reference" id="t_reference" placeholder="Introduzca el n&uacute;mero de referencia">
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
                                <textarea rows="5" cols="5" name="t_message" id="t_message" class="form-control" placeholder="Coloque aqu&iacute; un mensaje o informaci&oacute;n que desee agregar."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <form id="handleTransferenceUpload" name="handleTransferenceUpload" class="md-float-material form-material"  method="POST" action="javascript:void(0)" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title">Archivos Adjuntos</h4>
                    <div class="row m-b-20">
                        <div class="col-sm-12">
                            <div id="errorTransferenceAdj"></div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-11">
                                    <input type="file" class="form-control" name="t_file" id="t_file" style="margin-bottom: 5px;">
                                    <input type="text" name="t_ide_f" id="t_ide_f" hidden readonly>
                                </div>
                                <label class="col-sm-1"><button type="submit" class="btn btn-success">Subir</button></label>
                            </div>
                            <div class="col-sm-12">
                                <div id="TransferenceFiles"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-footer">
            <a class="btn btn-primary btn-block m-b-0" onclick="ConfirmTransference(1);">Registrar Pago</a>
        </div>
    </div>
</div>