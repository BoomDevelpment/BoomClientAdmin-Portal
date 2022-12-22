<div class="card">
    <div class="card-header"></div>
    <div class="card-block">
        <div class="row">

            @foreach($ab as $aab)
            <div class="col-xs-12 col-md-12 col-lg-4">
                @if($aab->status_id == 1)
                    <div class="card payment-card" style="background: honeydew; border-radius: 10px;">
                @else
                    <div class="card payment-card" style="border-radius: 10px;">
                @endif
                    <div>
                        <div class="row">
                            <div class="col-sm-4">
                                <i class="icofont icofont-bank-alt" style="font-size: 75px;"></i>
                            </div>
                            <div class="col-sm-8 text-right">
                                <strong class="m-r-5">Banco:</strong> <br> @foreach($bank as $bk)
                                    @if ($bk->id == $aab->bank_id)
                                        {{ $bk->name }}
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div>
                        <h5>**** **** **** {{ $aab->last }} </h5>
                        <div class="row m-t-10">
                            <div class="col-sm-4" style="font-size: 11px;">
                                <strong class="m-r-5">Tipo:</strong> <br> {{ $aab->type->name }}
                            </div>
                            <div class="col-sm-8 text-right" style="font-size: 11px;">
                                <strong class="m-r-5">Titular:</strong> <br> {{ $aab->name }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

        </div>

        <div class="col-xs-12 col-md-12 col-sm-12">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h5>Registro de Cuenta de Banco</h5>
                            <div class="m-t-10" id="err-AB"></div>
                        </div>
                        <div class="card-block" style="height: 500px;">
                            <form method="post" id="handleAB" name="handleAB" action="{{url('accountbank/register')}}" >
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label> Titular de la cuenta</label>
                                            <input type="text" id="aTitle" name="aTitle" class="form-control" placeholder="Titular de la cuenta">
                                        </div>
                                        <div class="form-group">
                                            <label>C&oacute;digo</label></label>
                                            <input type="text" class="form-control abve" id="aNumber" name="aNumber" data-mask="9999-9999-99-9999999999" placeholder="C&oacute;digo de Cuenta">
                                        </div>
                                        <div class="form-group" id="expiration-date">
                                            <div class="row">
                                                <div class="col-xs-12 col-sm-12 col-md-6">
                                                    <label>Entidad</label></label>
                                                    <select class="form-control m-b-10" id="aEntity" name="aEntity" style="font-size: 11px;"> 
                                                        @foreach($ab_entity as $ace)
                                                            @if ($ace->status_id == 1)
                                                                <option value="{{ $ace->id }}">{{ $ace->name }}</option>
                                                            @endif
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-xs-12 col-sm-12 col-md-6" >
                                                    <label>Tipo</label></label>
                                                    <select class="form-control m-b-10" id="aType" name="aType" style="font-size: 11px;">
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
                                            <label>Banco</label></label>
                                            <select name="aBank" id="aBank" class="form-control" style="font-size: 11px;">
                                                @foreach($bank as $bk)
                                                    @if ($bk->status_id == 1)
                                                        <option value="{{ $bk->id }}">{{ $bk->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-sm-12 text-center">
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
                            <h5>Cuentas de Banco Registradas</h5>
                            <div class="m-t-10" id="err-lAB"></div>
                        </div>
                        <div class="card-block" style="height: 500px;">
                            <div class="table-responsive">
                                <table class="table table-hover table-borderless" style="margin-bottom: 0px;">
                                    <thead>
                                        <tr>
                                            <th>Status</th>
                                            <th>Banco</th>
                                            <th>Codigo</th>
                                            <th>Tipo</th>
                                            <th>Acci&oacute;n</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($ab as $aab)
                                            <tr style="font-size: 12px;">
                                                @if($aab->status_id == 1)
                                                    <td><label class="label label-success">ACTIVO</label></td>   
                                                @else
                                                    <td><label class="label label-danger">INACTIVA</label></td>
                                                @endif
                                                @foreach($bank as $bk)
                                                    @if($bk->id == $aab->bank_id )
                                                        <td>{{ $bk->name }}</td>
                                                    @endif
                                                @endforeach
                                                <td>{{ $aab->type->name }}</td>
                                                <td>XXXX-{{ $aab->last }}</td>
                                                <td><a onClick="ABEditModal({{ $aab->id }});"  class="btn btn-info btn-outline-info btn-mini">Ver</a></td>
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