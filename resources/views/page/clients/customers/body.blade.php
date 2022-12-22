<div class="pcoded-wrapper">
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                
                <div class="page-wrapper">
                    <div class="page-body m-t-50">
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="card">
                                    <div class="card-block">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="card-block">
                                                    <div class="owl-carousel carousel-nav owl-theme">
                                                        @foreach ($pho as $ph)
                                                            <div>
                                                                <img class="d-block img-fluid" src="{{ asset($ph['src'].$ph['name']) }}" style="width: 100%">
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <form action='nothing' method='post' name='handleInvoice' style="text-align: -webkit-center;">
                                                    <button type="submit" class="btn btn-primary input-group-addon">Servicio Facturaci&oacute;n</button>
                                                </form>
                                            </div>
                                            <div class="col-lg-6">
                                                <form action='nothing' method='post' name='handleSupport' style="text-align: -webkit-center;">
                                                    <button type="submit" class="btn btn-primary input-group-addon">Servicio T&eacute;nico</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-block task-list">
                                                <div class="table-responsive">
                                                    <table id="simpletable" class="table dt-responsive task-list-table table-striped table-bordered nowrap">
                                                        <thead>
                                                            <tr>
                                                                <th style="text-align: center;">#</th>
                                                                <th style="text-align: center;">Ticket</th>
                                                                <th style="text-align: center;">Titulo</th>
                                                                <th style="text-align: center;">Tipo</th>
                                                                <th style="text-align: center;">Fecha</th>
                                                                <th style="text-align: center;">Estado</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="task-page">

                                                            @foreach ( $client->customers as $cl)
                                                                <tr>
                                                                    <td style="text-align: center;">{{ $cl->id }}</td>
                                                                    <td style="text-align: center;">{{ $cl->ticket }}</td>
                                                                    <td style="text-align: center;"><a href="#">{{ $cl->request->name }}</a></td>
                                                                    <td style="text-align: center;">{{ $cl->request->ctype->name }}</td>
                                                                    <td style="text-align: center;">{{ $cl->created_at->toDateString() }}</td>
                                                                    <td style="text-align: center;">
                                                                        @if ($cl->status->id == 2)
                                                                            <div class="card-footer bg-c-yellow" style="text-align: center;">
                                                                                <h6 class="text-white m-b-0">{{ $cl->status->name }}</h6>
                                                                            </div>
                                                                        @else
                                                                            <div class="card-footer bg-c-green" style="text-align: center;">
                                                                                <h6 class="text-white m-b-0">{{ $cl->status->name }}</h6>
                                                                            </div>
                                                                        @endif
                                                                    </td>
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
                </div>
            </div>
        </div>
    </div>
</div>