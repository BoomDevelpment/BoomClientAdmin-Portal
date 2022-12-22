<div class="modal" id="ModalUpload">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Carga de Archivo</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row m-b-10">
                    <div class="col-md-12" id="ModalUploadInfo"></div>
                </div>
                <form id="handleUpload" name="handleUpload" class="md-float-material"  method="POST" action="javascript:void(0)" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-6">
                            <p class="mb-2">Cargar Archivo</p>
                            <input type="file" class="form-control" name="file" id="file" style="margin-bottom: 5px;">
                            <input type="text" class="form-control" name="type" id="type" value="0" hidden>
                        </div>
                        <div class="col-lg-4">
                            <p class="mb-2">Delimitado</p>
                            <select class="form-control mb-3" name="delimite" id="delimite">
                                <option value="1" selected>Coma</option>
                                <option value="2">Punto y Coma</option>
                            </select>
                        </div>
                        <div class="col-lg-2">
                            <p class="mb-2"><br></p>
                            <button type="submit" id="BTNUploadModal" class="btn btn-success">Subir</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="javascript:;" class="btn btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-alert">
    <div class="modal-dialog modal-lg">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title">Visualizador</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="eVisualizer"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <p class="mb-2">Seleccione archivo adjunto</p>
                        <select class="form-control mb-3" name="imgList" id="imgList">
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <p class="text-justify">
                            <span class="fa-stack fa-4x pull-left m-r-10" style="text-align: center;">
                                <i class="fa fa-file-alt text-center"></i>
                            </span>
                            Im&aacute;genes de referencia suministradas por el cliente al momento de cargar su reporte de pago, por favor seleccionar de la lista la imagen que desea visualizar. 
                        </p>
                        <code class="text-justify">Para descargar o visualizar la imagen, hacer clic sobre la misma.</code>
                    </div>
                    <div class="col-md-8">
                        <div id="ModalImg" name="ModalImg">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="modal-report">
    <div class="modal-dialog">
        <div class="modal-content ">
            <div class="modal-header">
                <h4 class="modal-title">Visualizador de Informaci&oacute;n</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form id="handleEditReport" name="handleEditReport">
                    <div class="row">
                        <div class="col-md-12">
                            <div id="eVisReport"></div>
                        </div>
                    </div>
                    <div class="row row-space-10">
                        <div class="col-md-6 text-center">
                            <div class="form-group m-b-10">
                                <b>Codigo de Referncia</b>
                                <input class="form-control" type="text" id="crReport" name="crReport">
                                <input class="form-control" type="text" id="crIdReport" name="crIdReport" readonly hidden>
                            </div>
                        </div>
                        <div class="col-md-6 text-center">
                            <b>Monto</b>
                            <div class="form-group m-b-10">
                                <input class="form-control" type="text" id="arReport" name="arReport">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success text-white" id="btnReport" name="btnReport">Actualizar</button>
                    <a class="btn btn-white" data-dismiss="modal">Close</a>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal" id="modal-report-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Proceso de Consolidaci&oacute;n</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div id="eVisEdit"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="eBodyEdit">
                            <input class="form-control" type="text" id="tyREdit" name="tyREdit" value="" readonly hidden>
                            <h5 class="mb-2 text-center">Que desea hacer?</h5>
                            <select class="form-control mb-3" name="editCharger" id="editCharger">
                                <option value="">Seleccione una Opcion</option>
                                <option value="1">Suspender Seleccionados</option>
                                <option value="2">Suspender Todos</option>
                            </select>    
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-white" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div>