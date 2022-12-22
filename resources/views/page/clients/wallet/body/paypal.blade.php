<div class="card-block">
    <div class="table-responsive">
        <table class="table table-hover table-borderless" id="tblPaypal"  style="margin-bottom: 0px; text-align: center;">
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Referencia</th>
                    <th style="text-align: center;">Total $</th>
                    <th style="text-align: center;">Total Bs</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Registro</th>
                    <th style="text-align: center;">Ver mas</th>
                </tr>
            </thead>
            <tbody>
                @if(count($paypal) <> 0)
                    @foreach($paypal as $pp)
                        <tr>
                            <td>{{ $pp->id }}</td>
                            <td>{{ $pp->date_trans }}</td>
                            <td>{{ $pp->reference }}</td>
                            <td>$ {{ $pp->total }}</td>
                            <td>BS {{ $pp->bs }}</td>
                            @if($pp->status_id != 3)
                                <td><label class="label label-success">COMPROBADO</label></td>
                            @else
                                <td><label class="label label-danger">PENDIENTE</label></td>
                            @endif
                            <td>{{ $pp->created_at->toDateString() }}</td>
                            <td><a onClick="viewRegister({{ $pp->id }}, 2);" class="btn btn-info btn-outline-info btn-mini">Ver</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8"> SIN INFORMACI&Oacute;N ASOCIADA</td>
                    </tr>
                @endif
            </tbody>

        </table>
        @if(count($paypal) <> 0)
            <div class="text-right m-r-20">
                <a class=" b-b-primary text-primary" onclick="ViewTrans(2)">Ver Transacciones</a>
            </div>
        @endif
    </div>
</div>