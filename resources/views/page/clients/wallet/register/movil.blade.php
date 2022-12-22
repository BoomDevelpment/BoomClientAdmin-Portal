<div class="card">
    <div class="card-header">
        <h1 style="text-align: center; color:lightblue; font-family: fantasy;">Registro de Transferencia Pago Movil</h1>
        <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 42px; font-family: fantasy; color: green;" >
            <div id="salBCVWallet"> BCV {{ $divisa->dolar }} Bs</div>
            <div id="salBCVDateWallet" style="text-align: center; font-size: 18px; font-family: fantasy; color: lightgray;"> {{ $divisa->created_at }}</div>
        </div>
    </div>
    <div class="card-block">
        
        <form class="md-float-material form-material" id="handleMovil" name="handleMovil" >
            <div class="row m-b-20">
                <div class="col-sm-12 m-b-20">
                    <div id="errorMovil"></div>
                </div>
                <div class="col-sm-12 col-lg-6">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Asunto</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="m_asu" id="m_asu" placeholder="T&iacute;tulo de Transferencia">
                                    <input type="number" name="m_ide" id="m_ide" hidden readonly>
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
                                    <input type="text" class="form-control" name="m_title" id="m_title" placeholder="Nombre del titular de la cuenta">
                                    <span class="messages"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nº Telef&oacute;nico</label>
                                <div class="col-sm-9">
                                    <input type="number" class="form-control" name="m_phone" id="m_phone" placeholder="Numero telef&oacute;nico de pago movil">
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
                                    <input type="number" class="form-control" name="m_total" id="m_total" placeholder="Total del monto transferido">
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
                                    <input type="text" class="form-control" name="m_date" id="m_date" placeholder="Fecha de la transferencia">
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
                                    <input type="text" class="form-control" name="m_dni" id="m_dni" placeholder="Introduzca la C&eacute;dula o Rif">
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
                                    <select name="m_bank" id="m_bank" class="form-control">
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
                                    <input type="text" class="form-control" name="m_reference" id="m_reference" placeholder="Introduzca el n&uacute;mero de referencia">
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
                                <textarea rows="5" cols="5" name="m_message" id="m_message" class="form-control" placeholder="Coloque aqu&iacute; un mensaje o informaci&oacute;n que desee agregar."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        
        <form id="handleMovilUpload" name="handleMovilUpload" class="md-float-material form-material"  method="POST" action="javascript:void(0)" enctype="multipart/form-data">
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="sub-title">Archivos Adjuntos</h4>
                    <div class="row m-b-20">
                        <div class="col-sm-12">
                            <div id="errorMovilAdj"></div>
                        </div>
                    </div>
                    <div class="row"> 
                        <div class="col-sm-12">
                            <div class="form-group row">
                                <div class="col-sm-11">
                                    <input type="file" class="form-control" name="m_file" id="m_file" style="margin-bottom: 5px;">
                                    <input type="text" name="m_ide_f" id="m_ide_f" hidden readonly>
                                </div>
                                <label class="col-sm-1"><button type="submit" class="btn btn-success">Subir</button></label>
                            </div>
                            <div class="col-sm-12">
                                <div id="MovilFiles"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="card-footer">
            <a class="btn btn-primary btn-block m-b-0" onclick="ConfirmTransference(2);">Registrar Pago</a>
        </div>
    </div>
</div>