<div class="modal fade" id="NotInvoice" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="md-content">
                    <form action='nothing' method='post' id="handleRecInvoice" name="handleRecInvoice">
                        <div class="row">
                            <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                                <div id="sfError"></div>
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <div class="row">
                                <div class="col-md-12">
                                <label for="">Seleccione una solicitud</label>
                                    <div class="input-group">
                                        <select id="R" name="R" class="form-control stock">
                                            <option value="" selected>Seleccione una Opci&oacute;n</option>
                                            @foreach ($request as $req)
                                                @if ($req->status->id == 1 && $req->ctype->id == 2)
                                                <option value="{{ $req->id }}">{{ $req->name }}</option>
                                                @endif                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" name="pFiels" id="pFiels">
                                
                            </div>
                            <div class="text-center m-t-10">
                                <button type="submit" id="NotInvoices" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Procesar</button>
                                <button type="button" id="CloseRec" data-dismiss="modal" class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="NotSupport" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="md-content">
                    <form action='nothing' method='post' id="handleRecSupport" name="handleRecSupport">
                        <div class="row">
                            <div class="col-xl-12 col-md-12" style="text-align: center; font-size: 36px; font-family: fantasy; color: lightgray;" >
                                <div id="hrsError"></div>
                            </div>
                        </div>
                        <div style="margin-top: 10px;">
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="">Seleccione una solicitud</label>
                                    <div class="input-group">
                                        <select id="M" name="M" class="form-control stock">
                                            <option value="" selected>Seleccione una Opci&oacute;n</option>
                                            @foreach ($request as $req)
                                                @if ($req->status->id == 1 && $req->ctype->id == 1)
                                                <option value="{{ $req->id }}">{{ $req->name }}</option>
                                                @endif                                                
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row" name="mFiels" id="mFiels">
                            </div>
                            <div class="text-center m-t-10">
                                <button type="submit" id="NotServ" class="btn btn-primary waves-effect m-r-20 f-w-600 d-inline-block save_btn">Procesar</button>
                                <button type="button" id="CloseServ" data-dismiss="modal" class="btn btn-primary waves-effect m-r-20 f-w-600 md-close d-inline-block close_btn">Close</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>