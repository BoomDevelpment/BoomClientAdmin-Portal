<div class="card">
    <div class="card-block">
       
        <div class="row">
            
            @foreach($tdc as $k => $tc)
                @if($k < 3)
                <div class="col-xs-12 col-md-12 col-lg-4">
                    @if($tc->status_id == 1)

                        <div class="card payment-card" style="background: honeydew; border-radius: 10px;">
                    @else
                        <div class="card payment-card" style="border-radius: 10px;">
                    @endif
                        <div>
                            @foreach($cc_entity as $ent)
                                @if($tc->entity_id == $ent->id)
                                    <td><img src="{{ asset($ent->path) }}" alt="{{ $ent->name }}"></td>
                                @endif
                            @endforeach
                            <h5>**** **** ** {{ $tc->last }}</h5>
                            <div class="row m-t-10" style="font-size: 10px;">
                                <div class="col-sm-4">
                                    <strong class="m-r-5">Expiraci&oacute;n:</strong> <br> {{ $tc->month }}/{{ $tc->year }}
                                </div>
                                <div class="col-sm-8 text-right">
                                    <strong class="m-r-5">Titular:</strong> <br> {{ $tc->name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
            @endforeach
        </div>
            
            
            <div class="col-xs-12 col-md-12 col-sm-12">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h5>Registro de Tarjeta de Cr&eacute;dito</h5>
                                <div class="m-t-10" id="err-tdc">
                                </div>
                            </div>
                            <div class="card-block" style="height: 500px;">
                                <form method="post" class="md-float-material form-material" id="handleCC" name="handleCC" action="{{url('creditcard/register')}}" >
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label>Titular de la Tarjeta</label>
                                                <input type="text" name="cTitle" id="cTitle" class="form-control" placeholder="Titular de la Tarjeta">
                                            </div>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-8" >
                                                        <label >C&oacute;digo</label>
                                                        <input type="text" name="cNumber" id="cNumber" class="form-control tdcve"  data-mask="9999999999999999"  placeholder="C&oacute;digo de tarjeta">
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-4">
                                                        <label>CVV</label>
                                                        <input type="text" name="cCvv" id="cCvv" class="form-control tdccvv" data-mask="999" placeholder="CVV">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="expiration-date">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <label>Mes</label>
                                                        <select class="form-control m-b-10" name="cMonth" id="cMonth">
                                                            <option value="01">ENERO</option>
                                                            <option value="02">FEBRERO</option>
                                                            <option value="03">MARZO</option>
                                                            <option value="04">ABRIL</option>
                                                            <option value="05">MAYO</option>
                                                            <option value="06">JUNIO</option>
                                                            <option value="07">JULIO</option>
                                                            <option value="08">AGOSTO</option>
                                                            <option value="09">SEPTIEMBRE</option>
                                                            <option value="10">OCTUBRE</option>
                                                            <option value="11">NOVIEMBRE</option>
                                                            <option value="12">DICIEMBRE</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6" >
                                                        <label>A&ntilde;o</label>
                                                        <select class="form-control m-b-10" name="cYear" id="cYear">
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
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <label>Entidad</label>
                                                        <select class="form-control m-b-10" name="cEntity" id="cEntity" style="font-size: 11px;">
                                                            @foreach($cc_entity as $cce)
                                                                @if ($cce->status_id == 1)
                                                                    <option value="{{ $cce->id }}">{{ $cce->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-12 col-md-6">
                                                        <label>Tipo</label>
                                                        <select class="form-control m-b-10" name="cType" id="cType" style="font-size: 11px;">
                                                            @foreach($cc_type as $cct)
                                                                @if ($cct->status_id == 1)
                                                                    <option value="{{ $cct->id }}">{{ $cct->name }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group" id="debit-cards" style="text-align: center;">
                                                <img src="/src/images/payment/visa.jpg" id="visa" alt="visa.jpg">
                                                <img src="/src/images/payment/mastercard.jpg" id="mastercard" alt="mastercard.jpg">
                                                <img src="/src/images/payment/amex.jpg" id="amex" alt="amex.jpg">
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Registrar</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h5>Tarjetas de Credito Registradas</h5>
                        </div>
                        <div class="card-block" style="height: 500px;">
                            <div id="err-lTDC"></div>
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless" style="margin-bottom: 0px;">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Tipo</th>
                                            <th>Codigo</th>
                                            <th>Expiraci&oacute;n</th>
                                            <th>Acci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($tdc as $tc)
                                            <tr>
                                                @if($tc->status_id == 1)
                                                    <td><label class="label label-success">ACTIVO</label></td>   
                                                @else
                                                    <td><label class="label label-danger">INACTIVA</label></td>
                                                @endif

                                                @foreach($cc_entity as $ent)
                                                    @if($tc->entity_id == $ent->id)
                                                        <td><img src="{{ asset($ent->path) }}" style="width: 25px;" id="amex" alt="{{ $ent->name }}"></td>
                                                    @endif
                                                @endforeach
                                                <td>XXXX-{{ $tc->last }}</td>
                                                <td>{{ $tc->month }}/{{ $tc->year }}</td>
                                                <td><a onClick="TDCEditModal({{ $tc->id }});" class="btn btn-info btn-outline-info btn-mini">Ver</a></td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>