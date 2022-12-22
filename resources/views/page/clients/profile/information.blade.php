<div class="card">
    <div class="card-header"></div>
    <div class="card-block">
        <div class="row">
            <div class="col-lg-12">
                <div class="general-info">
                    <div id="err-INFO"></div>
                    <div class="row m-t-10">
                        <div class="col-lg-5">
                            <div class="table-responsive">
                                <div class="card bg-c-yellow text-white" style="text-align: center;">
                                    <div class="card-block">
                                        <div class="row m-l-0">
                                            <h6 class="m-b-10 text-white" >Plan Contratado</h6>
                                        </div>
                                        <h5 class="m-b-0">Internet Fibra Hasta 5Mb / 5 Mb</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card text-center text-white bg-c-green">
                                        <div class="card-block">
                                            <h6 class="m-b-0">Total Descarga</h6>
                                            <h4 class="m-t-10 m-b-10"><i class="feather icon-arrow-down m-r-15"></i>60.1 GB</h4>
                                            <p class="m-b-0">Resumen Mensual</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card text-center text-white bg-c-lite-green">
                                        <div class="card-block">
                                            <h6 class="m-b-0">Total Subida</h6>
                                            <h4 class="m-t-10 m-b-10"><i class="feather icon-arrow-up m-r-15"></i>7.8 GB</h4>
                                            <p class="m-b-0">Resumen Mensual</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-7">
                            <form method="post" class="md-float-material form-material" id="handleINFO" name="handleINFO" action="{{url('profile/update')}}" >
                            <div class="row">
                                <div class="col-sm-12 col-md-8 col-xl-8">
                                    <h6>Nombre Completo</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-user"></i></span>
                                        <input type="text" class="form-control" id="iName" name="iName" placeholder="Nombre Completo" value="{{ $data['name'] }}"> 
                                        <input type="text" name="iId" id="iId" value="{{ $data['id'] }}" class="form-control" hidden>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4">
                                    <h6>Fecha de Nacimiento</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i></span>
                                        <input type="text" class="form-control dateVE" id="iBirthday" data-mask="9999-99-99" name="iBirthday" placeholder="Fecha de Nacimiento" value="{{ $data['birthday'] }}"> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-12 col-xl-12">
                                    <h6>Direcci&oacute;n de Vivienda</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-address-book"></i></span>
                                        <input type="text" class="form-control" id="iAddress" name="iAddress" placeholder="Direcci&oacute;n de Vivienda" value="{{ $data['address'] }}"> 
                                        <input type="text" name="iId" id="iId" value="{{ $data['id'] }}" class="form-control" hidden>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-4 col-xl-4">
                                    <h6>Seleccione un Estado</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-globe-alt"></i></span>
                                        <select class="form-control" id="iState" name="iState"> 
                                            @foreach($estate as $est)
                                                @if ($est->status_id == 1)
                                                    @if ($data->estate_id == $est->id)
                                                        <option value="{{ $est->id }}" selected>{{ $est->name }}</option>    
                                                    @else
                                                        <option value="{{ $est->id }}">{{ $est->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4">
                                    <h6>Seleccione una Ciudad</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-building-alt"></i></span>
                                        <select class="form-control" id="iTown" name="iTown"> 
                                            @foreach($town as $tw)
                                                @if ($tw->status_id == 1)
                                                    @if ($data->city_id == $tw->id)
                                                        <option value="{{ $tw->id }}" selected>{{ $tw->name }}</option>    
                                                    @else
                                                        <option value="{{ $tw->id }}">{{ $tw->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-4 col-xl-4">
                                    <h6>Seleccione un Municipio</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-ui-home"></i></span>
                                        <select class="form-control" id="iMunicipality" name="iMunicipality"> 
                                            @foreach($township as $tws)
                                                @if ($tws->status_id == 1)
                                                    @if ($data->municipality_id == $tws->id)
                                                        <option value="{{ $tws->id }}" selected>{{ $tws->name }}</option>    
                                                    @else
                                                        <option value="{{ $tws->id }}">{{ $tws->name }}</option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6">
                                    <h6>Coordenadas Latitud</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                        <input type="text" class="form-control co_lat" data-mask="99.999999" id="iLatitud" name="iLatitud" placeholder="Latitud" value="{{ $data['latitude'] }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6">
                                    <h6>Coordenadas Longitud</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-location-pin"></i></span>
                                        <input type="text" class="form-control co_lon" data-mask="-99.999999" id="iLongitud" name="iLongitud" placeholder="Longitud" value="{{ $data['longitude'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6">
                                    <h6>Telefono Principal</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-telephone"></i></span>
                                        <input type="text" class="form-control telphone_with_code_ve" data-mask="(99) 999-9999999" id="iPhone" name="iPhone" placeholder="Tel&eacute;fono Principal" value="{{ $data['phone_principal'] }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6">
                                    <h6>Telefono Alterno</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-iphone"></i></span>
                                        <input type="text" class="form-control telphone_with_code_ve" data-mask="(99) 999-9999999" id="iPhoneAlt" name="iPhoneAlt" placeholder="Tel&eacute;fono Alterno" value="{{ $data['phone_alternative'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6">
                                    <h6>Email Principal</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-email"></i></span>
                                        <input type="email" class="form-control" id="iEmail" name="iEmail" placeholder="Email Principal" value="{{ $data['email_principal'] }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6">
                                    <h6>Email Alterno</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-envelope"></i></span>
                                        <input type="email" class="form-control" id="iEmailAlt" name="iEmailAlt" placeholder="Email Secundario" value="{{ $data['email_alternative'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6">
                                    <h6>Instagram</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-social-instagram"></i></span>
                                        <input type="text" class="form-control" id="iInstagram" name="iInstagram" placeholder="Instagram" value="{{ $data['instagram'] }}">
                                    </div>
                                    <h6>Twitter</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-social-twitter"></i></span>
                                        <input type="text" class="form-control" id=""iTwitter name="iTwitter" placeholder="Twitter" value="{{ $data['twitter'] }}">
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6">
                                    <h6>Facebook</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-social-facebook"></i></span>
                                        <input type="text" class="form-control" id="iFacebook" name="iFacebook" placeholder="Facebook" value="{{ $data['facebook'] }}">
                                    </div>
                                    <h6>Youtube</h6>
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-social-youtube"></i></span>
                                        <input type="text" class="form-control" id="iYoutube" name="iYoutube" placeholder="Youtube" value="{{ $data['youtube'] }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 col-md-6 col-xl-6" style="text-align: center;">
                                    <h6>Seleccione un G&eacute;nero</h6>
                                    <div class="form-radio">
                                        <div class="group-add-on">
                                            <div class="radio radiofill radio-inline">
                                                <label>
                                                    <input type="radio" id="iGender" name="iGender" value="1" <?php if ($data['gender_id'] == "1") echo "checked"; ?>><i class="helper"></i> Masculino
                                                </label>
                                            </div>
                                            <div class="radio radiofill radio-inline">
                                                <label>
                                                    <input type="radio" id="iGender" name="iGender" value="2" <?php if ($data['gender_id'] == "2") echo "checked"; ?>><i class="helper"></i> Femenino
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6 col-xl-6" style="text-align: center;">
                                    <h6>Recibir publicidad de nuestras redes sociales ?</h6>
                                    <div class="form-radio">
                                        <div class="group-add-on">
                                            <div class="radio radiofill radio-inline">
                                                <label>
                                                    <input type="radio" id="iAdvs" name="iAdvs"  value="SI" <?php if ($data['advertising'] == "SI") echo "checked"; ?> ><i class="helper"></i> Si
                                                </label>
                                            </div>
                                            <div class="radio radiofill radio-inline">
                                                <label>
                                                    <input type="radio" id="iAdvs" name="iAdvs" value="NO" <?php if ($data['advertising'] == "NO") echo "checked"; ?>><i class="helper"></i> No
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">Actualizar</button>
                            </div>
                        </form>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>