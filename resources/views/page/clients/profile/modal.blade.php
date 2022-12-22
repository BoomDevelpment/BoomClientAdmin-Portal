<div class="modal fade" id="TdcEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edici&oacute;n Tarjeta de Cr&eacute;dito</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background: aliceblue;">
                <div id="err-eTDC"></div><br>
                <form method="post" class="md-float-material form-material" id="handleECC" name="handleECC" action="{{url('creditcard/update')}}" >
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Titular de la Tarjeta</label>
                                <input type="text" name="mTitle" id="mTitle" class="form-control" placeholder="Titular de la Tarjeta">
                                <input type="text" name="mId" id="mId" class="form-control" hidden>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8" >
                                        <label >C&oacute;digo</label>
                                        <input type="text" name="mNumber" id="mNumber" class="form-control tdcve" data-mask="9999999999999999" placeholder="C&oacute;digo de tarjeta">
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>CVV</label>
                                        <input type="text" name="mCvv" id="mCvv" class="form-control tdccvv" data-mask="999" placeholder="CVV">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group" id="expiration-date">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <label>Mes</label>
                                        <select class="form-control m-b-10" name="mMonth" id="mMonth">
                                            <option value="1">ENERO</option>
                                            <option value="2">FEBRERO</option>
                                            <option value="3">MARZO</option>
                                            <option value="4">ABRIL</option>
                                            <option value="5">MAYO</option>
                                            <option value="6">JUNIO</option>
                                            <option value="7">JULIO</option>
                                            <option value="8">AGOSTO</option>
                                            <option value="9">SEPTIEMBRE</option>
                                            <option value="10">OCTUBRE</option>
                                            <option value="11">NOVIEMBRE</option>
                                            <option value="12">DICIEMBRE</option>
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6" >
                                        <label>A&ntilde;o</label>
                                        <select class="form-control m-b-10" name="mYear" id="mYear">
                                            {{ $last= date('Y')+15 }}
                                            {{ $now = date('Y') }}

                                            @for ($i = $now; $i <= $last; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Entidad</label>
                                        <select class="form-control m-b-10" name="mEntity" id="mEntity" style="font-size: 11px;">
                                            @foreach($cc_entity as $cce)
                                                @if ($cce->status_id == 1)
                                                    <option value="{{ $cce->id }}">{{ $cce->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Tipo</label>
                                        <select class="form-control m-b-10" name="mType" id="mType" style="font-size: 11px;">
                                            @foreach($cc_type as $cct)
                                                @if ($cct->status_id == 1)
                                                    <option value="{{ $cct->id }}">{{ $cct->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                        <label>Estado</label>
                                        <select class="form-control m-b-10" name="mStatus" id="mStatus" style="font-size: 11px;">
                                            @foreach($status as $st)
                                                <option value="{{ $st->id }}">{{ $st->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Actualizar</button>
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="ABEditModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edici&oacute;n Tarjeta de Cr&eacute;dito</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background: aliceblue;">
                <div id="err-eAB"></div><br>
                <form method="post" id="handleMAB" name="handleMAB" action="{{url('accountbank/update')}}" >
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label> Titular de la cuenta</label>
                                <input type="text" id="abTitle" name="abTitle" class="form-control" placeholder="Titular de la cuenta">
                            </div>
                            <div class="form-group">
                                <label>C&oacute;digo</label></label>
                                <input type="text" class="form-control abve" id="abNumber" name="abNumber" data-mask="9999-9999-99-9999999999" placeholder="C&oacute;digo de Cuenta">
                                <input type="number" class="form-control" id="abId" name="abId" hidden>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <label>Entidad</label></label>
                                        <select class="form-control m-b-10" id="abEntity" name="abEntity" style="font-size: 11px;"> 
                                            @foreach($ab_entity as $ace)
                                                @if ($ace->status_id == 1)
                                                    <option value="{{ $ace->id }}">{{ $ace->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6" >
                                        <label>Tipo</label></label>
                                        <select class="form-control m-b-10" id="abType" name="abType" style="font-size: 11px;">
                                            @foreach($ab_type as $aty)
                                                @if ($aty->status_id == 1)
                                                    <option value="{{ $aty->id }}">{{ $aty->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                        <label>Banco</label></label>
                                        <select name="abBank" id="abBank" class="form-control" style="font-size: 11px;">
                                            @foreach($bank as $bk)
                                                @if ($bk->status_id == 1)
                                                    <option value="{{ $bk->id }}">{{ $bk->name }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6" >
                                        <label>Estado</label></label>
                                        <select class="form-control m-b-10" id="abStatus" name="abStatus" style="font-size: 11px;">
                                            @foreach($status as $st)
                                                <option value="{{ $st->id }}">{{ $st->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary waves-effect waves-light ">Actualizar</button>
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>