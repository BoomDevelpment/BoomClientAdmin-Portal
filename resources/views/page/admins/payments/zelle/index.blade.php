@extends('layouts.admin')

@section('title', 'Boom Solutions')

@section('content')

<div id="content" class="content">
    
    @include('page.admins.payments.zelle.body')
    
    @include('page.admins.payments.zelle.modal')

</div>

@endsection

@section('js')



<script type="text/javascript">

/****************************************************************************************************/

$(document).ready(function() {
    Zelle.init();
});

/****************************************************************************************************/

var Zelle = function () {
	"use strict";
	return {
		init: function () {
			handleDateRangeFilter();
			handleLoad();
		}
	};
}();

/****************************************************************************************************/

var handleDateRangeFilter = function() {
	$('#daterange-filter span').html(moment().clone().startOf('month').format('D MMMM YYYY') + ' - ' + moment().clone().endOf('month').format('D MMMM YYYY'));

	$('#daterange-filter').daterangepicker({
		format: 'YYYY/MM/DD',
		startDate:  moment().startOf('month'),
		endDate:    moment().endOf('month'),
		minDate:    moment().startOf('month').format("YYYY-MM-DD"),
		maxDate:    moment().endOf('month').format("YYYY-MM-DD"),
		dateLimit: { days: 60 },
		showDropdowns: true,
		showWeekNumbers: true,
		timePicker: true,
		timePickerIncrement: 1,
		timePicker12Hour: true,
		ranges: {
			'Hoy': [moment(), moment()],
			'Ayer': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
			'Ultimos 7 Dias': [moment().subtract(6, 'days'), moment()],
			'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
			'Este Mes': [moment().startOf('month'), moment().endOf('month')],
			'Mes Antarior': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
		},
		opens: 'right',
		drops: 'down',
		buttonClasses: ['btn', 'btn-sm'],
		applyClass: 'btn-primary',
		cancelClass: 'btn-default',
		separator: ' to ',
		locale: {
			applyLabel: 'Submit',
			cancelLabel: 'Cancel',
			fromLabel: 'From',
			toLabel: 'To',
			customRangeLabel: 'Custom',
			daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
			monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
			firstDay: 1
		}
	}, function(start, end, label) {
		console.log(start.format('D MMMM YYYY'));
		console.log(end.format('D MMMM YYYY'));
		console.log(label);
		$('#daterange-filter span').html(start.format('D MMMM YYYY') + ' - ' + end.format('D MMMM YYYY'));
	});
};

var handleLoad 	= function() 
{
	fetch('/admins/payments/zelle/load', {
		headers:{ 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), },
		method: 'GET'
	})
	.then(response => {	if(!response.ok) throw Error(response.status);	return response.json()	})
	.then(function (response) {
			LoadTables(response);
			LoadInfo(response.info);
		}
	)
	.catch(error => console.log(error));
}

/****************************************************************************************************/

var LoadTables = function(data) {
	LoadTableClients(data.data);
	LoadTableCharger(data.consolidate);
	LoadTableProcess(data.data);
	LoadTableConsolidate(data.consolidate);
};

var LoadTableClients = function(data)
{
	$('#tClients').append('<table>');
	$.each(data, function(k, i) {
		if(i.status.id == 3)
		{
			console.log(i);
			var tr = $('<tr>').append(	
				$('<td>').html('<label class="checkbox"><input type="checkbox" name=clieId'+i.id+'" id=clieId'+i.id+'"><i></i></label>'),
				$('<td>').text(i.client.mikrowisp), $('<td>').text(i.client.name), $('<td>').text(i.date_trans), $('<td>').text(i.total.toFixed(2)),
				$('<td>').text(i.reference),
				$('<td>').html('<div class="alert alert-danger text-center" style="margin-bottom: 0; padding-bottom:0px; padding-top:0px;">'+i.status.name+'</div>'),
				$('<td>').html('<a class="btn btn-default btn-icon btn-lg" onclick="ViewFiles('+i.identified+')"><i class="fa fa-file-alt"></i></a>'),
				$('<td>').text(moment(i.created_at).format("YYYY-MM-DD H:m:s")),
				$('<td>').html('<a class="btn btn-default btn-icon btn-lg" onclick="EditReport('+i.id+')"><i class="fa fa-edit"></i></a>'),
			 );	$('#tClients').append(tr);
		}

    });	
	$('#tClients').append('</table>');
	$('#tClients').DataTable({
    	aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    	pageLength: 10,
		destroy: true,
    });
}

var LoadTableCharger = function(data)
{
	$('#tCharger').append('<table>');
	$.each(data, function(k, i) {
		if(i.status_id == 3)
		{
			var tr = $('<tr class="text-center">').append(	
				$('<td>').html('<label class="checkbox"><input type="checkbox" name="charId'+i.id+'" id="charId'+i.id+'"><i></i></label>'),
				$('<td>').text((k+1)), $('<td>').text(i.report_code), $('<td>').text(i.report_amount.toFixed(2)),$('<td>').text(i.report_date),
				$('<td>').html('<div class="alert alert-danger text-center" style="margin-bottom: 0; padding-bottom:0px; padding-top:0px;">'+i.status.name.toUpperCase()+'</div>'),
				$('<td>').text(i.operator.username.toUpperCase()),
				$('<td>').text(moment(i.created_at).format("YYYY-MM-DD H:m:s")),
			 );	$('#tCharger').append(tr);
		}
    });	
	$('#tCharger').append('</table>');
	$('#tCharger').DataTable({
    	aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    	pageLength: 10,
    });
}

var LoadTableProcess = function(data)
{
	$('#tProcess').append('<table>');
		$.each(data, function(k, i) {
		if(i.status.id == 2)
		{
			var tr = $('<tr>').append(	
				$('<td>').text(i.client.mikrowisp), $('<td>').text(i.client.name), $('<td>').text(i.reference), $('<td>').text(i.total.toFixed(2)),
				$('<td>').text(i.reference),
				$('<td>').html('<div class="alert alert-success text-center" style="margin-bottom: 0; padding-bottom:0px; padding-top:0px;">'+i.status.name+'</div>'),
					$('<td>').html('<button type="number" class="btn btn-default btn-icon btn-lg" onclick="ViewFiles('+i.identified+')"><i class="fa fa-file-alt"></i></button>'),
				$('<td>').text(moment(i.created_at).format("YYYY-MM-DD H:m:s")),
			 );	$('#tProcess').append(tr);
		}
    });	
	$('#tProcess').append('</table>');
	$('#tProcess').DataTable({
    	aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    	pageLength: 10,
		destroy: true,
    });
}

var LoadTableConsolidate = function(data)
{
	$('#tConsolidate').append('<table>');
		$.each(data, function(k, i) {
		if(i.status.id == 1)
		{
			var tr = $('<tr class="text-center">').append(	
				$('<td>').html('<label class="checkbox"><input type="checkbox" name="consId'+i.id+'" id="consId'+i.id+'"><i></i></label>'),
				$('<td>').text(i.client.mikrowisp), 			$('<td>').text(i.client.name),	$('<td>').text(i.report_code), 
				$('<td>').text(i.report_amount.toFixed(2)), 	$('<td>').text(i.report_date),	$('<td>').text(i.transference_code),
				$('<td>').text(i.transference_total.toFixed(2)),$('<td>').text(i.transference_date),
				$('<td>').html('<div class="alert alert-info text-center" style="margin-bottom: 0; padding-bottom:0px; padding-top:0px;">'+i.status.name+'</div>'),
				$('<td>').html('<a class="btn btn-default btn-icon btn-lg" onclick="ViewFiles('+i.zelle.identified+')"><i class="fa fa-file-alt"></i></a>'),
				$('<td>').text(moment(i.created_at).format("YYYY-MM-DD")),
			 );	$('#tConsolidate').append(tr);
		}
    });	
	$('#tConsolidate').append('</table>');
	$('#tConsolidate').DataTable({
    	aLengthMenu: [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]],
    	pageLength: 10,
		destroy: true,
    });
}

/****************************************************************************************************/

var LoadInfo = function(i)
{
	var tRec = document.getElementById('recInfo'); var tCon = document.getElementById('conInfo');
	var tPen = document.getElementById('penInfo');var tPro = document.getElementById('proInfo');
	var e1 	 = document.getElementById('E1-1');var e12 = document.getElementById('E1-2');
	var e13  = document.getElementById('E1-3');
	var e21  = document.getElementById('E2-1');var e22  = document.getElementById('E2-2');
	var e23  = document.getElementById('E2-3');var e24  = document.getElementById('E2-4');
	var e31  = document.getElementById('E3-1');var e32  = document.getElementById('E3-2');
	var e33  = document.getElementById('E3-3');var e34  = document.getElementById('E3-4');
	tRec.innerText = ''; tCon.innerText = ''; tPen.innerText = ''; tPro.innerText = '';
	e1.innerText   = ''; e12.innerText  = ''; e13.innerText  = '';
	e21.innerText  = ''; e22.innerText  = ''; e23.innerText  = ''; e24.innerText = '';
	e31.innerText  = ''; e32.innerText  = ''; e33.innerText  = ''; e34.innerText = '';
	tRec.append(i.E.r); tCon.append(i.E.c); tPen.append(i.E.pe); tPro.append(i.E.pr);	
	e1.append(i.E1.t);  e12.append(i.E1.r);	e13.append(i.E1.a);	
	e21.append(i.E2.T); e22.append(i.E2.s.pr); e23.append(i.E2.s.pe); e24.append(i.E2.s.co);
	e31.append(i.E3.T); e32.append(i.E3.s.pr); e33.append(i.E3.s.pe);e34.append(i.E3.s.co);
}

/****************************************************************************************************/

$("#uploadFiles").click(function(e)
{
	$('#ModalUpload').modal('show');
});

$("#handleUpload").submit(function(e) 
{
	e.preventDefault();
	var formData = new FormData(this);
	$('#BTNUploadModal').attr('disabled',true);
	document.getElementById('ModalUploadInfo').innerText='';
	$("#ModalUploadInfo").html("<div class='alert alert-info' style='margin-bottom: 0;'>Processing file, please wait</div>");

	var request = $.ajax({
		type:   'POST',
		url:    "{{url('/admins/payments/zelle/upload')}}",
		data:   formData,
		cache: false,
		contentType: false,
		processData: false,
		headers:{
			'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
		}
	});
	request.done(function(data){
		e.preventDefault();
		document.getElementById('ModalUploadInfo').innerText='';
		$('#handleUpload')[0].reset();
		$('#BTNUploadModal').attr('disabled',false);

		if(data.success == true)
		{			
			var ronde1n = [];
			const datos = data.idata;
			ronde1n.push("Date, Code, Estatus");
			datos.forEach(function (i) {
				ronde1n.push("\r\n" + i.date + "," + i.code + "," + i.status + "");
			});

			var blob = new Blob([ronde1n], {type: "application/csv;charset=utf-8"});
			var download_link = document.createElement("a");
			download_link.href = URL.createObjectURL(blob);
			download_link.download = "DownloadFileZelle"+moment()+".csv";
			document.body.appendChild(download_link);
			download_link.click();
			document.body.removeChild(download_link);

			setTimeout(function () {	window.location.reload();	}, 5000);

			swal({
				title: 'Successfully',
				text: 'Data loaded correctly',
				icon: 'success',
				buttons: {
					confirm: {
						text: 'OK', value: true, visible: true, className: 'btn btn-success', closeModal: true
					}
				}
			});
			$('#ModalUpload').modal('hide');
		}else{
			document.getElementById('ModalUploadInfo').innerText='';
			$("#ModalUploadInfo").html("<div class='alert alert-warning' style='margin-bottom: 0;'>"+data.message+"</div>");
		}
	})
	request.fail(function(response)
	{
		document.getElementById('ModalUploadInfo').innerText='';
		$("#ModalUploadInfo").html("<div class='alert alert-danger' style='margin-bottom: 0;'>" + JSON.parse(response.responseText).message + "</div>");
		$('#handleUpload')[0].reset();
		$('#BTNUploadModal').attr('disabled',false);
	})

	return false;
});

$("#handleEditReport").submit(function(e) 
{
	e.preventDefault();
	var request = $.ajax({
		type:   'POST',
		url:    "{{url('/admins/payments/zelle/reference/edit')}}",
		data:   new FormData(this),
		cache: false,
		contentType: false,
		processData: false,
		headers:{
			'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
		},
		beforeSend: function( xhr ) {
			document.getElementById('eVisEdit').innerText='';
			$('#handleEditReport')[0].reset()
			$('#modal-report').modal('hide');
			blockUI();
		}
	});
	request.done(function(data){
		$.unblockUI();
		$('#handleEditReport')[0].reset();
		swalTrue(data.message)

		// setTimeout(function () {	window.location.reload();	}, 5000);

	})
	request.fail(function(response)
	{
		$('#handleEditReport')[0].reset();
		$.unblockUI();
		swalFalse(JSON.parse(response.responseText).message);
	})

	return false;
});

/****************************************************************************************************/

$('#searchConsolidate').click(function(e) {
	e.preventDefault();
	fetch('/admins/payments/zelle/consolidate', {
		headers:{ 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), },
		method: 'GET'
	})
	.then(response => {	if(!response.ok) throw Error(response.status);	return response.json()	})
	.then(function (response) {
			var info = new Object();
			if(response.status == true)
			{	info.title 	= 	'Successfully';	info.text 	=	''+response.message+' - Please wait for page update' ;	info.icon 	=	'success';
				setTimeout(function () {	window.location.reload();	}, 5000);
			}else{	info.title 	= 	'Information!'; 		info.text 	=	response.message; 	info.icon 	=	'info'; 	}
			swal({
				title: info.title,
				text: info.text,
				icon: info.icon,
				buttons: {
					confirm: {
						text: 'OK', value: true, visible: true, className: 'btn btn-success', closeModal: true
					}
				}
			});
		}
	)
	.catch(error => console.log(error));

	return false;
});

$('#processConsolidate').click(function(e) {
	e.preventDefault();
	fetch('/admins/payments/zelle/consolidate', {
		headers:{ 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') },
		method: 'POST'
	})
	.then(response => {	if(!response.ok) throw Error(response.status);	return response.json()	})
	.then(function (response) {
			var info = new Object();
			if(response.status == true)
			{	info.title 	= 	'Successfully';	info.text 	=	''+response.process+' - '+response.Pending+' - Please wait for page update' ;	info.icon 	=	'success';
				setTimeout(function () {	window.location.reload();	}, 5000);
			}else{	info.title 	= 	'Information!'; 		info.text 	=	response.message; 	info.icon 	=	'info'; 	}
			swal({
				title: info.title,
				text: info.text,
				icon: info.icon,
				buttons: {
					confirm: {
						text: 'OK', value: true, visible: true, className: 'btn btn-success', closeModal: true
					}
				}
			});
		}
	)
	.catch(error => console.log(error));

	return false;
});

/****************************************************************************************************/

$('#actionsCharge').click(function (e) {
	document.getElementById('tyREdit').value = 'charge';
	$('#modal-report-edit').modal('show');
});

$('#actionsReloadCharge').click(function (e) {
	$.gritter.add({
		title: 'Reload Page',
		text: 'This page will reload in approximately 5 seconds..',
		class_name: 'gritter-light'
	});

	setTimeout(function () {	window.location.reload();	}, 5000);

});

$('#actionsClient').click(function (e) {
	document.getElementById('tyREdit').value = 'client';
	$('#modal-report-edit').modal('show');
});

$('#actionsReloadClient').click(function (e) {
	$.gritter.add({
		title: 'Reload Page',
		text: 'This page will reload in approximately 5 seconds..',
		class_name: 'gritter-light'
	});

	setTimeout(function () {	window.location.reload();	}, 5000);

});

$('#actionsConsolidate').click(function (e) {
	document.getElementById('tyREdit').value = 'consolidate';
	$('#modal-report-edit').modal('show');
});

$('#actionsReloadConsolidate').click(function (e) {
	$.gritter.add({
		title: 'Reload Page',
		text: 'This page will reload in approximately 5 seconds..',
		class_name: 'gritter-light'
	});

	setTimeout(function () {	window.location.reload();	}, 5000);

});

document.querySelector('#editCharger').addEventListener('change', (event) => {
	var tp = document.getElementById('tyREdit').value;
	var ref = document.getElementById('editCharger').value;
	document.getElementById('eVisEdit').innerText='';
	if(ref != '')
	{
		if(tp == 'charge')		{	var data = $('#dataCharge').serialize();	}
		if(tp == 'client')		{	var data = $('#dataClient').serialize();	}
		if(tp == 'consolidate')	{	var data = $('#dataConsolidate').serialize();	}

		var request = $.ajax({
			url:    '/admins/payments/zelle/edit',
			type:   'post',
			data:   {id: ref, tp:tp, data: data},
			headers:{
				'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
				'Content-Type': 	'application/x-www-form-urlencoded'
			},
			beforeSend: function( xhr ) {
				document.getElementById('eVisEdit').innerText='';
				$("#editCharger option[value='']").attr("selected", true);
				$('#modal-report-edit').modal('hide');
				blockUI();
			}
		});
		request.done(function(data)
		{
			document.getElementById('eVisEdit').innerText='';
			$("#editCharger option[value='']").attr("selected", true);
			$.unblockUI();
			swalTrue(data.message);
		})
		request.fail(function(response)
		{
			document.getElementById('eVisEdit').innerText='';
			$.unblockUI();
			swalFalse(JSON.parse(response.responseText).message);
		});
	}else{
		$("#editCharger option[value='']").attr("selected", true);
	}
	return false;
});

/****************************************************************************************************/

var searchFile = function(file) 
{
	$('#ModalImg').html('');
	document.getElementById('eVisualizer').innerText='';
	document.getElementById('imgList').innerText='';

	var request = $.ajax({
		url:    '/admins/payments/zelle/img',
		type:   'post',
		data:   {ref: file, ty: 1},
		headers:{
			'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 	'application/x-www-form-urlencoded'
		}
	});
	request.done(function(data){
		var x = document.getElementById("imgList");
		$.each(data.datos, function(k, i) {
			var option = document.createElement("option");
			option.value = i.id;
			option.text = 'Imagen #'+(k+1)+'';
			x.add(option);
		});
		$('#ModalImg').html('');
		$('#ModalImg').prepend($('<a href="/img.php?img='+data.datos[0].name+'&type=1" target="_blank"><img src="/'+data.datos[0].dir_name+'/'+data.datos[0].name+'" style="max-width: 500px;"></a>'));

		document.querySelector('#imgList').addEventListener('change', (event) => {
			var ref = document.getElementById('imgList').value;
			document.getElementById('eVisualizer').innerText='';
			var request = $.ajax({
				url:    '/admins/payments/zelle/img/id',
				type:   'post',
				data:   {id: ref, ty: 1},
				headers:{
					'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
					'Content-Type': 	'application/x-www-form-urlencoded'
				}
			});
			request.done(function(data)
			{
				$('#ModalImg').html('');
				$('#ModalImg').prepend($('<a href="/img.php?img='+data.datos.name+'&type=1" target="_blank"><img src="/'+data.datos.dir_name+'/'+data.datos.name+'" style="max-width: 500px;"></a>'));
			})
			request.fail(function(response)
			{
				document.getElementById('eVisualizer').innerText='';
				$("#eVisualizer").html("<div class='alert alert-danger' style='margin-bottom: 0;'>" + JSON.parse(response.responseText).message + "</div>");
			});
			return false;
		});

		$('#modal-alert').modal('show');
	})
	request.fail(function(response)
	{
		document.getElementById('eVisualizer').innerText='';
		$("#eVisualizer").html("<div class='alert alert-danger' style='margin-bottom: 0;'>" + JSON.parse(response.responseText).message + "</div>");

	});
	return false;
}

var searchReport = function(file) 
{
	$('#ModalImg').html('');
	document.getElementById('eVisualizer').innerText='';
	document.getElementById('imgList').innerText='';

	var request = $.ajax({
		url:    '/admins/payments/zelle/img',
		type:   'post',
		data:   {ref: file, ty: 1},
		headers:{
			'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 	'application/x-www-form-urlencoded'
		}
	});
	request.done(function(data){
		var x = document.getElementById("imgList");
		$.each(data.datos, function(k, i) {
			var option = document.createElement("option");
			option.value = i.id;
			option.text = 'Imagen #'+(k+1)+'';
			x.add(option);
		});
		$('#ModalImg').html('');
		$('#ModalImg').prepend($('<a href="/img.php?img='+data.datos[0].name+'&type=1" target="_blank"><img src="/'+data.datos[0].dir_name+'/'+data.datos[0].name+'" style="max-width: 500px;"></a>'));

		document.querySelector('#imgList').addEventListener('change', (event) => {
			var ref = document.getElementById('imgList').value;
			document.getElementById('eVisualizer').innerText='';
			var request = $.ajax({
				url:    '/admins/payments/zelle/img/id',
				type:   'post',
				data:   {id: ref, ty: 1},
				headers:{
					'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
					'Content-Type': 	'application/x-www-form-urlencoded'
				}
			});
			request.done(function(data)
			{
				$('#ModalImg').html('');
				$('#ModalImg').prepend($('<a href="/img.php?img='+data.datos.name+'&type=1" target="_blank"><img src="/'+data.datos.dir_name+'/'+data.datos.name+'" style="max-width: 500px;"></a>'));
			})
			request.fail(function(response)
			{
				document.getElementById('eVisualizer').innerText='';
				$("#eVisualizer").html("<div class='alert alert-danger' style='margin-bottom: 0;'>" + JSON.parse(response.responseText).message + "</div>");
			});
			return false;
		});

		$('#modal-alert').modal('show');
	})
	request.fail(function(response)
	{
		document.getElementById('eVisualizer').innerText='';
		$("#eVisualizer").html("<div class='alert alert-danger' style='margin-bottom: 0;'>" + JSON.parse(response.responseText).message + "</div>");

	});
	return false;
}

function ViewFiles(id)
{
	document.getElementById('eVisualizer').innerText='';
	document.getElementById('imgList').innerText='';
	searchFile(id);
	$('#modal-alert').modal('show');
}

function EditReport(id)
{
	var request = $.ajax({
		url:    '/admins/payments/zelle/edit',
		type:   'get',
		data:   {id: id},
		headers:{
			'X-CSRF-TOKEN': 	$('meta[name="csrf-token"]').attr('content'),
			'Content-Type': 	'application/x-www-form-urlencoded'
		}
	});
	request.done(function(data){
		document.getElementById('crReport').innerText='';
		document.getElementById('arReport').innerText='';
		document.getElementById('crIdReport').innerText='';
	
		$('#crReport').val(data.data.reference);
		$('#arReport').val(data.data.total);
		$('#crIdReport').val(data.data.id);
	
		$('#modal-report').modal('show');
	})
	request.fail(function(response)
	{
		document.getElementById('crReport').innerText='';
		document.getElementById('arReport').innerText='';
		document.getElementById('crIdReport').innerText='';

		swal({
			title: 'Error',
			text: 'An error has occurred, please try again',
			icon: 'error',
			buttons: {
				confirm: {
					text: 'OK', value: true, visible: true, className: 'btn btn-error', closeModal: true
				}
			}
		});
		$('#modal-report').modal('hide');
	});
	return false;
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

function swalTrue(message) 
{
	swal({
		title: 'Success',
		text: message,
		icon: 'success',
		buttons: {
			confirm: {
				text: 'OK', value: true, visible: true, className: 'btn btn-success', closeModal: true
			}
		}
	});
}

function swalFalse(message) 
{
	swal({
		title: 'Error',
		text: message,
		icon: 'error',
		buttons: {
			confirm: { text: 'OK', value: true, visible: true, className: 'btn btn-danger', closeModal: true
			}
		}
	});
}
/****************************************************************************************************/



/****************************************************************************************************/











/****************************************************************************************************/

</script>

@endsection