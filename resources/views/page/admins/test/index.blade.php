@extends('layouts.admin')

@section('title', 'Boom Solutions')

@section('content')

<div id="content" class="content">

    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="javascript:;">Promociones</a></li>
    </ol>

    <section>
        <h1 class="page-header">Politicas Comerciales</h1>
        <form name="handlerWizard" id="handlerWizard">
            <div id="wizard">
                <ul>
                    <li>
                        <a href="#step-1">
                            <span class="number">1</span> 
                            <span class="info">
                                Informaci&oacute;n de Promoci&oacute;n
                                <small>Nombre y Costo</small>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-2">
                            <span class="number">2</span> 
                            <span class="info">
                                Recurrencia de Promoci&oacute;n
                                <small>Meses que durar&aacute; la promoci&oacute;n</small>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-3">
                            <span class="number">3</span>
                            <span class="info">
                                Informaci&oacute;n de Activaci&oacute;n
                                <small>Recurrencia y costos</small>
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#step-4">
                            <span class="number">4</span> 
                            <span class="info">
                                Finalizaci&oacute;n
                                <small>Creaci&oacute;n de Promoci&oacute;n</small>
                            </span>
                        </a>
                    </li>
                </ul>

                <div>
                    
                <div id="step-1">
                    <fieldset>
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Informaci&oacute;n de la Promoci&oacute;n</legend>
                                
                                <div class="form-group row m-b-10">
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="form-group">
                                            <label for="text-lg-right col-form-label"><strong>T&iacute;tulo</strong></label>
                                            <input type="text" id="tPromo" name="tPromo" data-parsley-group="step-1" data-parsley-required="true" placeholder="Primer Trimestre del A&ntilde;o" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-xl-6">
                                        <div class="form-group">
                                            <label for="text-lg-right col-form-label"><strong>Subtitulo</strong><small>&nbsp;(Mostrado en factura)</small></label>
                                            <input type="text" id="sbPromo" name="sbPromo" data-parsley-group="step-1" data-parsley-required="true" placeholder="Titulo Mostrado en Factura" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row m-b-10">
                                    <div class="col-lg-9 col-xl-6">
                                        <label for="text-lg-right col-form-label"><strong>Costo del Paquete</strong></label>
                                        <div class="input-group input-daterange">
                                            <input type="text" id="cPromo" name="cPromo" data-parsley-group="step-1" data-parsley-required="true" placeholder="19.99" class="form-control autonumber" />
                                            <span class="input-group-addon">IVA</span>
                                            <input type="text" id="cIvaPromo" name="cIvaPromo" data-parsley-group="step-1" data-parsley-required="true" value="16" placeholder="% 16" class="form-control autonumber" />
                                        </div>
                                    </div>

                                    <div class="col-lg-9 col-xl-6">
                                        <label for="text-lg-right col-form-label"><strong>Costo de la Instalaci&oacute;n</strong></label>
                                        <div class="input-group input-daterange">
                                            <input type="text" id="iPromo" name="iPromo" data-parsley-group="step-1" data-parsley-required="true" placeholder="199.99" class="form-control autonumber" />
                                            <span class="input-group-addon">IVA</span>
                                            <input type="text" id="iIvaPromo" name="iIvaPromo" data-parsley-group="step-1" data-parsley-required="true" value="16" placeholder="% 16" class="form-control autonumber" />
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row m-b-10">
                                    <div class="col-lg-9 col-xl-3">
                                        <div class="form-group">
                                            <label for="text-lg-right col-form-label"><strong>Estado</strong></label>
                                            <select class="form-control" id="esPromo" name="esPromo" data-parsley-group="step-1" data-parsley-required="true">
                                                @foreach ($estates as $es)
                                                    @if ($es->status_id == 1)
                                                        <option value="{{ $es->id }}">{{ $es->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-xl-3">
                                        <div class="form-group">
                                            <label for="text-lg-right col-form-label"><strong>Ciudad</strong></label>
                                            <select class="form-control" id="ciPromo" name="ciPromo" data-parsley-group="step-1" data-parsley-required="true">
                                                @foreach ($estates as $es)
                                                    @foreach ($es->citys as $city)
                                                        @if ($city->status_id == 1)
                                                            <option value="{{ $city->id }}">{{ $city->name }}</option>
                                                        @endif        
                                                    @endforeach
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-xl-3">
                                        <div class="form-group">
                                            <label for="text-lg-right col-form-label"><strong>Tipo</strong></label>
                                            <select class="form-control" id="tyPromo" name="tyPromo" data-parsley-group="step-1" data-parsley-required="true">
                                                @foreach ($type as $ty)
                                                    @if ($ty->status_id == 1)
                                                        <option value="{{ $ty->id }}">{{ $ty->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-9 col-xl-3">
                                        <div class="form-group">
                                            <label for="text-lg-right col-form-label"><strong>Tecnolog&iacute;a</strong></label>
                                            <select class="form-control" id="tePromo" name="tePromo" data-parsley-group="step-1" data-parsley-required="true">
                                                @foreach ($technology as $tec)
                                                    @if ($tec->status_id == 1)
                                                        <option value="{{ $tec->id }}">{{ $tec->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row m-b-10">
                                    <div class="col-lg-12 col-xl-12">
                                        <label for="text-lg-right col-form-label"><strong>Fechas de Promoci&oacute;n</strong></label>
                                        <div class="input-group input-daterange">
                                            <input type="text" id="dIniPromo" name="dIniPromo" data-parsley-group="step-1" data-parsley-required="true" data-date-format="yyyy-mm-dd" placeholder="Fecha de Inicio" class="form-control" />
                                            <span class="input-group-addon">to</span>
                                            <input type="text" id="dEndPromo" name="dEndPromo" data-parsley-group="step-1" data-parsley-required="true" data-date-format="yyyy-mm-dd" placeholder="Fecha Finalizaci&oacute;n" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                </div>

                <div id="step-2">
                    <fieldset>
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                
                                <div class="form-group row m-b-10">
                                    <div class="col-md-6" style="text-align: center;">
                                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Listado de Meses por Promoci&oacute;n</legend>
                                    </div>
                                    <div class="col-md-6" style="text-align: right;">
                                        <a href="javascript:;" onclick="AddRecurrenceItems();" class="btn btn-sm btn-primary">Agregar</a>                                            
                                    </div>
                                </div>
                                <div class="form-group row m-b-10">

                                    <div class="table-responsive">
                                        <table id="rPromotion" class="table table-striped table-bordered table-hover m-b-0">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>Mes</th>
                                                    <th>Costo</th>
                                                    <th>Multiplicador</th>
                                                    <th>IVA</th>
                                                    <th>Total</th>
                                                    <th>Acci&oacute;n</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </fieldset>
                </div>

                <div id="step-3">
                    <fieldset>
                        <div class="row">
                            <div class="col-xl-8 offset-xl-2">
                                
                                <div class="form-group row m-b-10">
                                    <div class="col-md-6" style="text-align: center;">
                                        <legend class="no-border f-w-700 p-b-0 m-t-0 m-b-20 f-s-16 text-inverse">Listado de Meses por instalaci&oacute;n</legend>
                                    </div>
                                    <div class="col-md-6" style="text-align: right;">
                                        <a href="javascript:;" onclick="AddInstalationItems();" class="btn btn-sm btn-primary">Agregar</a>                                            
                                    </div>
                                </div>
                                <div class="form-group row m-b-10">

                                    <div class="table-responsive">
                                        <table id="rInstalations" class="table table-striped table-bordered table-hover m-b-0">
                                            <thead>
                                                <tr style="text-align: center;">
                                                    <th>Mes</th>
                                                    <th>Costo</th>
                                                    <th>Multiplicador</th>
                                                    <th>IVA</th>
                                                    <th>Total</th>
                                                    <th>Acci&oacute;n</th>
                                                </tr>
                                            </thead>
                                            <tbody style="text-align: center;">
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </fieldset>
                </div>
        </form>
                <div id="step-4">
                    <div id="wizard-submit">
                        <form name="form-wizard" id="form-wizard" class="form-control-with-bg">
                            <div class="jumbotron m-b-0 text-center">
                                <h5 class="display-4">Desea crear la promoci&oacute;n? </h5>
                                <p><button type="submit"class="btn btn-primary btn-lg">Procesar</button></p>
                            </div>
                        </form>
                    </div>
                    <div id="wizard-success" hidden>
                        <div class="jumbotron m-b-0 text-center">
                            <h2 class="display-4">Registro Satisfactorio</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

@section('js')

<script type="text/javascript">

/****************************************************************************************************/

$(document).ready(function() {
	FormWizardValidation.init();
	FromDatePicker.init();
});

/****************************************************************************************************/

var handleWizard = function() {
	"use strict";
	$('#wizard').smartWizard({ 
		selected: 0, 
		theme: 'default',
		transitionEffect:'',
		transitionSpeed: 0,
		useURLhash: false,
		showStepURLhash: false,
		toolbarSettings: {
			toolbarPosition: 'bottom'
		}
	});
	$('#wizard').on('leaveStep', function(e, anchorObject, stepNumber, stepDirection) 
    {
		var res = $('form[name="handlerWizard"]').parsley().validate('step-' + (stepNumber + 1));
		
        if(stepNumber == 0)
        {
            var cost  = document.getElementById("cPromo").value; 
            var inst  = document.getElementById("iPromo").value; 
            var ivaC  = document.getElementById("cIvaPromo").value; 
            var ivaI  = document.getElementById("iIvaPromo").value; 

            if($('#RMO1').length == 0)
            {
                $('#rPromotion').append('<table>');
                $('#rPromotion').append('<tr id="RMID1"><td><input type="text" id="RMO1" name="RMO1" readonly value="1" data-parsley-group="step-2" data-parsley-required="true" placeholder="1" class="form-control text-center autonumber"></td><td><input type="text" id="RCO1" name="RCO1" readonly value="'+cost+'" data-parsley-group="step-2" data-parsley-required="true" placeholder="'+cost+'" class="form-control text-center autonumber"></td><td><input type="text" id="RMU1" name="RMU1" data-parsley-group="step-2" data-parsley-required="true" value="100" placeholder="100" class="form-control text-center autonumber"></td><td><input type="text" id="RIVA1" name="RIVA1" data-parsley-group="step-2" data-parsley-required="true" value="'+ivaC+'" placeholder="'+ivaC+'" class="form-control text-center autonumber"></td><td><input type="text" id="RTO1" name="RTO1" value="'+( ((100/100) * cost) + ( (ivaC/100) * cost)  ).toFixed(2) +'" data-parsley-group="step-2" data-parsley-required="true" placeholder=""'+cost+'"" class="form-control text-center autonumber"></td><td><a href="#" onclick=RemoveItems(1) class="btn btn-sm btn-danger btn-block text-center">Remover</a></td></tr>');
                $('#rPromotion').append('</table>');

                $('#rInstalations').append('<table>');
                $('#rInstalations').append('<tr id="IAID0"><td><input type="text" id="IAO0" name="IAO0" readonly value="0" data-parsley-group="step-3" data-parsley-required="true" placeholder="1" class="form-control text-center autonumber"></td><td><input type="text" id="ICO0" name="ICO0" readonly value="'+inst+'" data-parsley-group="step-3" data-parsley-required="true" placeholder="'+inst+'" class="form-control text-center autonumber"></td><td><input type="text" id="IMU0" name="IMU0" data-parsley-group="step-3" data-parsley-required="true" value="100" placeholder="100" class="form-control text-center autonumber"></td><td><input type="text" id="IIVA0" name="IIVA0" data-parsley-group="step-3" data-parsley-required="true" value="'+ivaI+'" placeholder=="'+ivaI+'" class="form-control text-center autonumber"></td><td><input type="text" id="ITO0" name="ITO0" value="'+( ((100/100) * inst) + ( (ivaI/100) * inst)  ).toFixed(2) +'" value="'+( (100/100) * inst)+'" data-parsley-group="step-3" data-parsley-required="true" placeholder=""'+inst+'"" class="form-control text-center autonumber"></td><td><a href="#" onclick=RemoveItemsInst(1) class="btn btn-sm btn-danger btn-block text-center">Remover</a></td></tr>');
                $('#rInstalations').append('</table>');
            }
        }
		return res;
	});
	
	$('#wizard').keypress(function( event ) {
		if (event.which == 13 ) {
			$('#wizard').smartWizard('next');
		}
	});
};

var handleDatePicker = function() {
    $('#dIniPromo').datepicker({
        todayHighlight: true,
        autoclose: true
    });

    $('#dEndPromo').datepicker({
        todayHighlight: true,
        autoclose: true
    });
};

/****************************************************************************************************/

var FormWizardValidation = function () {
	"use strict";
	return {
		//main function
		init: function () {
			handleWizard();
		}
	};
}();

var FromDatePicker = function () {
	"use strict";
	return {
		//main function
		init: function () {
            handleDatePicker();
		}
	};
}();

/****************************************************************************************************/

$('#rInstalations').on('input', ':input', function() { 
    var id = $(this).prop('name').slice(3);

    if($(this).prop('name').slice(0,3) == "IMU")
    {
        $('#ITO'+id+'').val('');
        $('#ITO'+id+'').val( ( ( (parseFloat($(this).val())/100) * parseFloat($('#ICO'+id+'').val()) ) + ( (parseFloat($('#IIVA'+id+'').val())/100) * ( (parseFloat($(this).val())/100) * parseFloat($('#ICO'+id+'').val())) ) ).toFixed(2) );

    }else if ($(this).prop('name').slice(0,3) == "IIV"){

        var id = $(this).prop('name').slice(4);

        $('#ITO'+id+'').val('');
        $('#ITO'+id+'').val( ( ( (parseFloat($('#IMU'+id+'').val())/100) * parseFloat($('#ICO'+id+'').val())) + ( (parseFloat($(this).val())/100) * (parseFloat($('#IMU'+id+'').val())/100) * parseFloat($('#ICO'+id+'').val())) ).toFixed(2) );

    }else if ($(this).prop('name').slice(0,3) == "ITO") {

        $('#IMU'+id+'').val('');
        $('#IMU'+id+'').val( (( parseFloat($(this).val()) / (( parseFloat($('#ICO'+id+'').val())  * (parseFloat($('#IIVA'+id+'').val())/100)) + parseFloat($('#ICO'+id+'').val())) ) * 100).toFixed(2) );
    }
});

$('#rPromotion').on('input', ':input', function() { 
    var id = $(this).prop('name').slice(3);

    if($(this).prop('name').slice(0,3) == "RMU")
    {
        $('#RTO'+id+'').val('');
        $('#RTO'+id+'').val( ( ( (parseFloat($(this).val())/100) * parseFloat($('#RCO'+id+'').val()) ) + ( (parseFloat($('#RIVA'+id+'').val())/100) * ( (parseFloat($(this).val())/100) * parseFloat($('#RCO'+id+'').val())) ) ).toFixed(2) );

    }else if ($(this).prop('name').slice(0,3) == "RIV"){

        var id = $(this).prop('name').slice(4);

        $('#RTO'+id+'').val('');
        $('#RTO'+id+'').val( ( ( (parseFloat($('#RMU'+id+'').val())/100) * parseFloat($('#RCO'+id+'').val())) + ( (parseFloat($(this).val())/100) * (parseFloat($('#RMU'+id+'').val())/100) * parseFloat($('#RCO'+id+'').val())) ).toFixed(2) );

    }else if ($(this).prop('name').slice(0,3) == "RTO") {

        $('#RMU'+id+'').val('');
        $('#RMU'+id+'').val( (( parseFloat($(this).val()) / (( parseFloat($('#RCO'+id+'').val())  * (parseFloat($('#RIVA'+id+'').val())/100)) + parseFloat($('#RCO'+id+'').val())) ) * 100).toFixed(2) );
    }
});

/****************************************************************************************************/

function AddRecurrenceItems()
{
    var cost = document.getElementById("cPromo").value;
    var ivaC = document.getElementById("cIvaPromo").value; 
    var i = 1;
    while($('#RMO'+i+'').length == 1){ i++; }

    $('#rPromotion').append('<table>');
    $('#rPromotion').append('<tr id="RMID'+i+'"><td><input type="text" id="RMO'+i+'" name="RMO'+i+'" readonly value="'+i+'" data-parsley-group="step-2" data-parsley-required="true" placeholder="'+i+'" class="form-control text-center autonumber"></td><td><input type="text" id="RCO'+i+'" name="RCO'+i+'" readonly value="'+cost+'" data-parsley-group="step-2" data-parsley-required="true" placeholder="'+cost+'" class="form-control text-center autonumber"></td><td><input type="text" id="RMU'+i+'" name="RMU'+i+'" data-parsley-group="step-2" data-parsley-required="true" value="100" placeholder="100" class="form-control text-center autonumber"></td><td><input type="text" id="RIVA'+i+'" name="RIVA'+i+'" data-parsley-group="step-2" data-parsley-required="true" value="'+ivaC+'" placeholder="'+ivaC+'" class="form-control text-center autonumber"></td><td><input type="text" id="RTO'+i+'" name="RTO'+i+'" value="'+( ((100/100) * cost) + ( (ivaC/100) * cost)  ).toFixed(2)+'" data-parsley-group="step-2" data-parsley-required="true" placeholder="'+cost+'" class="form-control text-center autonumber"></td><td><a href="#" onclick=RemoveItems('+i+') class="btn btn-sm btn-danger btn-block text-center">Remover</a></td></tr>');
    $('#rPromotion').append('</table>');
}

function AddInstalationItems()
{
    var inst  = document.getElementById("iPromo").value;
    var ivaI  = document.getElementById("iIvaPromo").value;
    var i = 1;
    while($('#IAO'+i+'').length == 1){ i++; }

    $('#rInstalations').append('<table>');
    $('#rInstalations').append('<tr id="IAID'+i+'"><td><input type="text" id="IAO'+i+'" name="IAO'+i+'" readonly value="'+i+'" data-parsley-group="step-3" data-parsley-required="true" placeholder="'+i+'" class="form-control text-center autonumber"></td><td><input type="text" id="ICO'+i+'" name="ICO'+i+'" readonly value="'+inst+'" data-parsley-group="step-3" data-parsley-required="true" placeholder="'+inst+'" class="form-control text-center autonumber"></td><td><input type="text" id="IMU'+i+'" name="IMU'+i+'" data-parsley-group="step-3" data-parsley-required="true" value="100" placeholder="100" class="form-control text-center autonumber"></td><td><input type="text" id="IIVA'+i+'" name="IIVA'+i+'" data-parsley-group="step-2" data-parsley-required="true" value="'+ivaI+'" placeholder="'+ivaI+'" class="form-control text-center autonumber"></td><td><input type="text" id="ITO'+i+'" name="ITO'+i+'" value="'+( ((100/100) * inst) + ( (ivaI/100) * inst)  ).toFixed(2)+'" data-parsley-group="step-3" data-parsley-required="true" placeholder=""'+inst+'"" class="form-control text-center autonumber"></td><td><a href="#" onclick=RemoveItemsInst('+i+') class="btn btn-sm btn-danger btn-block text-center">Remover</a></td></tr>');
    $('#rInstalations').append('</table>');
}

function RemoveItems(id)
{
    if(id == 1)
    {
        window.alert("El primer mes de promocion no puede ser eliminado");
    }else{
        $('#RMID'+id+'').remove();
    }
}

function RemoveItemsInst(id)
{
    if(id == 1)
    {
        window.alert("El primer mes de promocion de Instalacion no puede ser eliminado");
    }else{
        $('#IAID'+id+'').remove();
    }
}

function blockUI()
{
    $.blockUI({ css: {
    border: 'none',
    padding: '15px',
    backgroundColor: '#000',
        '-webkit-border-radius': '10px',
        '-moz-border-radius': '10px',
    opacity: .5,
    color: '#fff'
}});

}

/****************************************************************************************************/

$('#form-wizard').submit(function(){
    blockUI();

    var request = $.ajax({
        url:    '{{url('/admins/policy/register')}}',
        type:   'POST',
        data:   $('#handlerWizard').serialize(), 
        headers:{
            'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
            'Content-Type': 	'application/x-www-form-urlencoded'
        }
    });
    request.done(function(data){
        $.unblockUI();
        swal({
            title: 'Success!',text: data.message,icon: 'success',
            buttons: {confirm: { text: 'Success',value: true,visible: true,className: 'btn btn-success',closeModal: true}}
        });

        setTimeout( function() { window.location = data.url; }, 3000); 
    })
    request.fail(function(response)
    {
        $.unblockUI();   
        swal({
            title: 'Error!',text: JSON.parse(response.responseText).message ,icon: 'error',
            buttons: {confirm: { text: 'Error',value: true,visible: true,className: 'btn btn-error',closeModal: true}}
        });
        swal("Error!", JSON.parse(response.responseText).message);
    });

    return false;
});

/****************************************************************************************************/

</script>


@endsection