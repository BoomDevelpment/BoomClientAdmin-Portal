<div class="card-block">
    <div class="table-responsive">
        <table class="table table-hover table-borderless" id="tblBank" style="margin-bottom: 0px; text-align: center;">
            <thead>
                <tr>
                    <th style="text-align: center;">#</th>
                    <th style="text-align: center;">C&oacute;digo</th>
                    <th style="text-align: center;">Fecha</th>
                    <th style="text-align: center;">Total $</th>
                    <th style="text-align: center;">Total Bs</th>
                    <th style="text-align: center;">Status</th>
                    <th style="text-align: center;">Registro</th>
                    <th style="text-align: center;">Ver mas</th>
                </tr>
            </thead>
            <tbody>
                @if(count($trans) <> 0)
                    @foreach($trans as $tb)
                        <tr>
                            <td>{{ $tb->id }}</td>
                            <td>{{ $tb->date_trans }}</td>
                            <td>{{ $tb->reference }}</td>
                            <td>$ {{ $tb->total }}</td>
                            <td>BS {{ $tb->bs }}</td>
                            @if($tb->status_id != 3)
                                <td><label class="label label-success">COMPROBADO</label></td>
                            @else
                                <td><label class="label label-danger">PENDIENTE</label></td>
                            @endif
                            <td>{{ $tb->created_at->toDateString() }}</td>
                            <td><a onClick="viewRegister({{ $tb->id }}, 3);" class="btn btn-info btn-outline-info btn-mini">Ver</a></td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8"> SIN INFORMACI&Oacute;N ASOCIADA</td>
                    </tr>
                @endif
            </tbody>
        </table>
        @if(count($trans) <> 0)
            <div class="text-right m-r-20">
                <a class=" b-b-primary text-primary" onclick="ViewTrans(3)">Ver Transacciones</a>
            </div>
        @endif
    </div>
</div>