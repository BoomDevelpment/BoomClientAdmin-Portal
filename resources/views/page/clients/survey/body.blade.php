<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <!-- Main-body start -->
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-block">
                                    <div class="row">
                                        <div class="col-lg-12 col-xl-12">
                                            <h1 class="font-weight-bold" style="text-align: center; color: #001c62;">Encuesta</h1>
                                            <h6 class="font-weight-bold" style="text-align: center; color: #001c62;">Tu opini&oacute;n nos ayuda a crecer, al finalizar esta encuesta podr&aacute;s reportar tu pago</h1>
                                            
                                                <div class="card-block">
                                                    <form method="post" class="md-float-material form-material" id="handleSurvey" name="handleSurvey" >
                                                        <div class="row">
                                                            <div class="col-sm-12 col-lg-12">
                                                                <div class="row">
                                                                    <div class="col-sm-4">
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label" style="text-align: justify;">{{ $q[0]->name }}</label>
                                                                            <input type="text" name="qRatingId" id="qRatingId" hidden value="{{ $q[0]->id }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-radio">
                                                                            <div class="radio radiofill radio-primary radio-inline">
                                                                                @for ($i = 0; $i < (count($q[0]->questions)/2); $i++)
                                                                                    <label><input type="radio" name="qRating" value="{{ $q[0]->questions[$i]->id }}" data-bv-field="qRating"><i class="helper"></i> {{ $q[0]->questions[$i]->name }}</label>
                                                                                @endfor
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-sm-4">
                                                                        <div class="form-radio">
                                                                            <div class="radio radiofill radio-primary radio-inline">
                                                                                @for ($i = (count($q[0]->questions)/2); $i < count($q[0]->questions); $i++)
                                                                                    <label><input type="radio" name="qRating" value="{{ $q[0]->questions[$i]->id }}" data-bv-field="qRating"><i class="helper"></i> {{ $q[0]->questions[$i]->name }}</label>
                                                                                @endfor
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row m-t-10">
                                                                    <div class="col-sm-6">
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label" style="text-align: justify;">{{ $q[1]->name }}</label>
                                                                            <input type="text" name="qAttId" id="qAttId" hidden value="{{ $q[1]->id }}">
                                                                        </div>
                                                                    </div>
                
                                                                    @for ($i = 0; $i < count($q[1]->questions); $i++)
                                                                        <div class="col-sm-2">
                                                                            <div class="form-radio">
                                                                                <div class="radio radiofill radio-primary radio-inline">
                                                                                    <label><input type="radio" name="qAtt" value="{{ $q[1]->questions[$i]->id }}" data-bv-field="qAtt"><i class="helper"></i>{{ $q[1]->questions[$i]->name }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endfor
                                                                </div>
                                                                
                                                                    <h6 class="font-weight-bold" style="text-align: center; color: #001c62;">Coloca el nombre y número de teléfono de cinco (05) seres queridos y te apoyaremos para que tu próxima mensualidad sea</h6>
                                                                    <h2 class="font-weight-bold" style="text-align: center; color: #001c62;">TOTALMENTE GRATIS</h2>
                
                                                                    @for ($i=1; $i<6; $i++)
                                                                        <div class="row">
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-3 col-form-label">Nombre</label>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="text" class="form-control form-control-sm" name="qrName{{ $i }}" id="qrName{{ $i }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-sm-6">
                                                                                <div class="form-group row">
                                                                                    <label class="col-sm-3 col-form-label">Tel&eacute;fono</label>
                                                                                    <div class="col-sm-9">
                                                                                        <input type="number" class="form-control form-control-sm" name="qrPhone{{ $i }}" id="qrPhone{{ $i }}">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endfor
                
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <div class="form-group row">
                                                                            <label class="col-form-label" style="text-align: justify;">{{ $q[2]->name }}</label>
                                                                            <input type="text" name="qHandId" id="qHandId" hidden value="{{ $q[2]->id }}">
                                                                        </div>
                                                                    </div>
                
                                                                    @for ($i = 0; $i < count($q[2]->questions); $i++)
                                                                        <div class="col-sm-2">
                                                                            <div class="form-radio">
                                                                                <div class="radio radiofill radio-primary radio-inline">
                                                                                    <label><input type="radio" name="qHand" value="{{ $q[2]->questions[$i]->id }}" data-bv-field="qHand"><i class="helper"></i>{{ $q[2]->questions[$i]->name }}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endfor
                                                                </div>   
                                                                <div class="row">
                                                                    <button class="btn btn-primary btn-block">Registrar Encuesta</button>
                                                                    {{-- <a class="btn btn-primary btn-block" style="color: white;" onclick="ProcessPaypal();">Registrar Encuesta</a> --}}
                                                                </div>                                                            
                                                            </div>
                                                        </div>
                                                    </form>
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