<div class="card-block">
    <div class="table-responsive">
        <table class="table table-hover table-borderless" id="tblZelle" style="margin-bottom: 0px; text-align: center;">
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Referencial</th>
                    <th style="text-align: center;">Total $</th>
                    <th style="text-align: center;">Total Bs</th>
                    <th style="text-align: center;">Depositado</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Registro</th>
                    <th style="text-align: center;">Ver mas</th>
                </tr>
            </thead>
            <tbody>
                <div>
                    @if(count($zelle) <> 0)
                        @foreach($zelle as $zl)
                            <tr>
                                <td>{{ $zl->id }}</td>
                                <td>{{ $zl->date_trans }}</td>
                                <td>{{ $zl->reference }}</td>
                                <td>$ {{ $zl->total }}</td>
                                <td>BS {{ $zl->bs }}</td>
                                <td>$ {{ $zl->amount }}</td>
                                @if($zl->status_id != 3)
                                    <td><label class="label label-success">COMPROBADO</label></td>
                                @else
                                    <td><label class="label label-danger">PENDIENTE</label></td>
                                @endif
                                <td>{{ $zl->created_at->toDateString() }}</td>
                                <td><a onClick="viewRegister({{ $zl->id }}, 1);" class="btn btn-info btn-outline-info btn-mini">Ver</a></td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="8"> SIN INFORMACI&Oacute;N ASOCIADA</td>
                        </tr>
                    @endif
                </div>
            </tbody>
        </table>
        @if(count($zelle) <> 0)
            <div class="text-right m-r-20">
                <a class=" b-b-primary text-primary" onclick="ViewTrans(1)">Ver Transacciones</a>
            </div>
        @endif
    </div>
</div>