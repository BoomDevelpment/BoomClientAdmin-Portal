<div class="modal fade" id="ViewTransModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Confirmaci&oacute;n de Pagos</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="background: aliceblue;">
                <form id="ViewTransForm">
                    <div class="row">
                        <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                            <div id="pError"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12">
                            <dl class="dl-horizontal row">
                                <dt class="col-sm-3">Asunto</dt>
                                <dd class="col-sm-9"><div id="vSub"></div></dd>
                                <dt class="col-sm-3">Descripci&oacute;n</dt>
                                <dd class="col-sm-9"><div id="vDes"></div></dd>
                                <dt class="col-sm-3">Fecha</dt>
                                <dd class="col-sm-9"><div id="vDate"></div></dd>
                                <dt class="col-sm-3">Referencia</dt>
                                <dd class="col-sm-9"><div id="vRef"></div></dd>
                                <dt class="col-sm-3">Total $</dt>
                                <dd class="col-sm-9"><div id="vToD"></div></dd>
                                <dt class="col-sm-3">Total BS</dt>
                                <dd class="col-sm-9"><div id="vToB"></div></dd>
                            </dl>
                        </div>
                        <div class="col-xl-12 col-md-12">
                            <div class="row users-card">
                                <div id="vImg"></div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a class="btn btn-primary btn-block m-b-0" onclick="ProcessPaypal();">Registrar Pago</a>
                <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>