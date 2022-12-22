<div class="row m-b-20">
    <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6">
        <div class="float-md-left float-lg-left float-xl-left float-xs-left">
            <a href="#" class="btn btn-inverse mr-2 text-truncate" id="daterange-filter">
                <i class="fa fa-calendar fa-fw text-white-transparent-5 ml-n1"></i>
                <span>{{ $date->firstOfMonth()->format('j F Y') }} - {{ $date->lastOfMonth()->format('j F Y') }}</span>
                <b class="caret"></b>
            </a>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6">
        <div class="float-md-right float-lg-right float-xl-right float-xs-right">
            <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate" id="uploadFiles"><i class="fa fa-cloud-upload-alt fa-fw text-white-transparent-5 ml-n1"></i> Upload File</a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-teal">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">RECIBIDOS</div>
                <div class="stats-number text-center" id="recInfo">0</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 100%;"></div>
                </div>
                <div class="stats-desc">Transacciones Recibidas</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-blue">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-code-branch fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">CONSOLIDADOS</div>
                <div class="stats-number text-center" id="conInfo">0</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 100%;"></div>
                </div>
                <div class="stats-desc">Pendientes Consolidados</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-indigo">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-clock fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">PENDIENTES</div>
                <div class="stats-number text-center" id="penInfo">0</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 100%;"></div>
                </div>
                <div class="stats-desc">Pendientes sin Consolidar</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-dark">
            <div class="stats-icon stats-icon-lg"><i class="fa fa-check-circle fa-fw"></i></div>
            <div class="stats-content">
                <div class="stats-title">PROCESADOS</div>
                <div class="stats-number text-center" id="proInfo">0</div>
                <div class="stats-progress progress">
                    <div class="progress-bar" style="width: 100%;"></div>
                </div>
                <div class="stats-desc">Total Procesados</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <ul class="nav nav-tabs nav-tabs-inverse nav-justified nav-justified-mobile" data-sortable-id="index-2">
            <li class="nav-item"><a href="#statistics" data-toggle="tab" class="nav-link active"><i class="fa fa-chart-area fa-lg m-r-5"></i> <span class="d-none d-md-inline">Estadisticas</span></a></li>
            <li class="nav-item"><a href="#consolidated" data-toggle="tab" class="nav-link"><i class="fa fa-code-branch fa-lg m-r-5"></i> <span class="d-none d-md-inline">Consolidados</span></a></li>
            <li class="nav-item"><a href="#charge" data-toggle="tab" class="nav-link"><i class="fa fa-cloud-upload-alt fa-lg m-r-5"></i> <span class="d-none d-md-inline">Cargados</span></a></li>
            <li class="nav-item"><a href="#clients" data-toggle="tab" class="nav-link"><i class="fa fa-clock fa-lg m-r-5"></i> <span class="d-none d-md-inline">Clientes</span></a></li>
            <li class="nav-item"><a href="#process" data-toggle="tab" class="nav-link"><i class="fa fa-check-circle fa-lg m-r-5"></i> <span class="d-none d-md-inline">Procesados</span></a></li>
        </ul>
        <div class="tab-content" data-sortable-id="index-3">
            <div class="tab-pane fade active show" id="statistics">
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card border-0 mb-3 overflow-hidden bg-dark text-white">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-xl-7 col-lg-8">
                                        <div class="text-grey text-center">
                                            <b>TOTAL TRANSFERENCIAS</b>
                                        </div>
                                        <div class="mb-3 text-grey text-center">
                                            Estadisticas Generalres
                                        </div>
                                        <div class="text-center">
                                            <h2 class="mb-0 text-center">$ <span data-animation="number" data-value="0.00" id="E1-1" >0.00</span></h2>
                                        </div>
                                        <hr class="bg-white-transparent-2" />
                                        <div class="row text-truncate">
                                            <div class="col-6">
                                                <div class="f-s-12 text-grey text-center">Total Recibidas</div>
                                                <div class="f-s-18 m-b-5 f-w-600 p-b-1 text-center" data-animation="number" id="E1-2" data-value="0.00">0</div>
                                                <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                                    <div class="progress-bar progress-bar-striped rounded-right bg-teal" data-animation="width" data-value="100%" style="width: 0%"></div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="f-s-12 text-grey text-center">Avg. Por Transferencia</div>
                                                <div class="f-s-18 m-b-5 f-w-600 p-b-1 text-center">$ <span data-animation="number" id="E1-3" data-value="0.00">0.00</span></div>
                                                <div class="progress progress-xs rounded-lg bg-dark-darker m-b-5">
                                                    <div class="progress-bar progress-bar-striped rounded-right" data-animation="width" data-value="100%" style="width: 0%"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5 col-lg-4 align-items-center d-flex justify-content-center">
                                        <img src="{{ asset('src/admin/images/img-1.svg') }}" height="150px" class="d-none d-lg-block" />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="card border-0 text-truncate mb-3 bg-dark text-white">
                                    <div class="card-body">
                                        <div class="text-grey text-center">
                                            <b>TRANSFERENCIAS RECIBIDAS</b>
                                        </div>
                                        <div class="mb-2 text-grey text-center">
                                            M&eacute;tricas de Procesamiento
                                        </div>
                                        <div class="text-center">
                                            <h2 class="text-white mb-0 text-center"><span data-animation="number" data-value="0.00" id="E2-1">0.00</span> %</h2>
                                            <div class="ml-auto">
                                                <div id="conversion-rate-sparkline"></div>
                                            </div>
                                        </div>

                                        <hr class="bg-white-transparent-2" />

                                        <div class="d-flex mb-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                                Procesadas
                                            </div>
                                            <div class="d-flex align-items-center ml-auto">
                                                <div class="text-grey f-s-11"><i class="fa fa-caret-right"></i> <span data-animation="text" data-value="" ></span></div>
                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0.00" id="E2-2">0.00</span>%</div>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                                Pendientes
                                            </div>
                                            <div class="d-flex align-items-center ml-auto">
                                                <div class="text-grey f-s-11"><i class="fa fa-caret-right"></i> <span data-animation="text" data-value=""></span></div>
                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0.00" id="E2-3">0.00</span>%</div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                                Conciliado
                                            </div>
                                            <div class="d-flex align-items-center ml-auto">
                                                <div class="text-grey f-s-11"><i class="fa fa-caret-right"></i> <span data-animation="text" data-value=""></span></div>
                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0.00" id="E2-4">0.00</span>%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="card border-0 text-truncate mb-3 bg-dark text-white">
                                    <div class="card-body">
                                        <div class="text-grey text-center">
                                            <b>DINERO RECIBIDO</b>
                                        </div>
                                        <div class="mb-2 text-grey text-center">
                                            M&eacute;tricas de Procesamiento
                                        </div>

                                        <div class="text-center">
                                            <h2 class="text-white mb-0 text-center"><span data-animation="number" data-value="0.00" id="E3-1">0.00</span> %</h2>
                                            <div class="ml-auto">
                                                <div id="conversion-rate-sparkline"></div>
                                            </div>
                                        </div>

                                        <hr class="bg-white-transparent-2" />

                                        <div class="d-flex mb-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                                Procesadas
                                            </div>
                                            <div class="d-flex align-items-center ml-auto">
                                                <div class="text-grey f-s-11"><i class="fa fa-caret-right"></i> <span data-animation="text" data-value=""></span></div>
                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0.00" id="E3-2">0.00</span>%</div>
                                            </div>
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                                Pendiente
                                            </div>
                                            <div class="d-flex align-items-center ml-auto">
                                                <div class="text-grey f-s-11"><i class="fa fa-caret-right"></i> <span data-animation="text" data-value=""></span></div>
                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0.00" id="E3-3">0.00</span>%</div>
                                            </div>
                                        </div>
                                        <div class="d-flex">
                                            <div class="d-flex align-items-center">
                                                <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                                Conciliado
                                            </div>
                                            <div class="d-flex align-items-center ml-auto">
                                                <div class="text-grey f-s-11"><i class="fa fa-caret-right"></i> <span data-animation="text" data-value=""></span></div>
                                                <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number" data-value="0.00" id="E3-4">0.00</span>%</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="consolidated">
                <div class="panel panel-inverse" data-sortable-id="table-basic-2">
                    <div class="panel-body">
                        <div class="row m-b-20">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6" >
                                <div class="float-md-left float-lg-left float-xl-left float-xs-left">
                                    <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate mb-20" id="searchConsolidate"><i class="fa fa-cogs fa-fw text-white-transparent-5 ml-n1"></i> Consolidation</a>
                                    <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate mb-20" id="actionsReloadConsolidate"><i class="fas fa-spinner fa-spin fa-fw text-white-transparent-5 ml-n1"></i> Reload Info</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6" >
                                <div class="float-md-right float-lg-right float-xl-right float-xs-right">
                                    <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate mb-20" id="actionsConsolidate"><i class="fa fa-edit fa-fw text-white-transparent-5 ml-n1"></i> Acciones</a>
                                    <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate mb-20" id="processConsolidate"><i class="fa fa-check fa-fw text-white-transparent-5 ml-n1"></i> Process</a>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="table-responsive">
                                <form id="dataConsolidate" name="dataConsolidate">
                                    <table id="tConsolidate" class="table table-hover m-b-0 text-inverse">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Cliente</th>
                                                <th>Codigo</th>
                                                <th>Total</th>
                                                <th>Fecha</th>
                                                <th>Referencia</th>
                                                <th>Monto</th>
                                                <th>Fecha</th>
                                                <th>Status</th>
                                                <th>File</th>
                                                <th>Registro</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="charge">
                <div class="panel panel-inverse" data-sortable-id="table-basic-2">
                    <div class="panel-body">
                        <div class="row m-b-20">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6" >
                                <div class="float-md-left float-lg-left float-xl-left float-xs-left">
                                    <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate mb-20" id="actionsReloadCharge"><i class="fas fa-spinner fa-spin fa-fw text-white-transparent-5 ml-n1"></i> Reload Info</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6" >
                                <div class="float-md-right float-lg-right float-xl-right float-xs-right">
                                    <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate mb-20" id="actionsCharge"><i class="fa fa-edit fa-fw text-white-transparent-5 ml-n1"></i> Acciones</a>
                                </div>
                            </div>
                        </div>
                        <form id="dataCharge" name="dataCharge">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="tCharger" class="table table-hover m-b-0 text-inverse">
                                        <thead>
                                            <tr class="text-center">
                                                <th>#</th>
                                                <th>ID</th>
                                                <th>Referencia</th>
                                                <th>Monto</th>
                                                <th>Reporte</th>
                                                <th>Status</th>
                                                <th>Ejecutivo</th>
                                                <th>Registro</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>                                
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="clients">
                <div class="panel panel-inverse" data-sortable-id="table-basic-2">
                    <div class="panel-body">
                        <div class="row m-b-20">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6" >
                                <div class="float-md-left float-lg-left float-xl-left float-xs-left">
                                    <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate mb-20" id="actionsReloadClient"><i class="fas fa-spinner fa-spin fa-fw text-white-transparent-5 ml-n1"></i> Reload Info</a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xs-6" >
                                <div class="float-md-right float-lg-right float-xl-right float-xs-right">
                                    <a href="javascript:void(0)" class="btn btn-inverse mr-2 text-truncate mb-20" id="actionsClient"><i class="fa fa-edit fa-fw text-white-transparent-5 ml-n1"></i> Acciones</a>
                                </div>
                            </div>
                        </div>
                        <form id="dataClient" name="dataClient">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="tClients" class="table table-hover m-b-0 text-center">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Id</th>
                                                <th>Client</th>
                                                <th>Transferencia</th>
                                                <th>Total</th>
                                                <th>Referencia</th>
                                                <th>Status</th>
                                                <th>Image</th>
                                                <th>Registro</th>
                                                <th>Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="process">
                <div class="panel panel-inverse" data-sortable-id="table-basic-2">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table id="tProcess" class="table table-hover m-b-0 text-center">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Client</th>
                                        <th>Transferencia</th>
                                        <th>Total</th>
                                        <th>Referencia</th>
                                        <th>Image</th>
                                        <th>Registro</th>
                                        <th>Operator</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>