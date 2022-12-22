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
                                            <div class="col-lg-6 offset-lg-3">
                                                <h2 class="txt-highlight text-center m-t-20">Realiza tu donativo aqui</h2>
                                                <p class="text-center">Recuerda que este dinero sera descontado desde tu billetera</p>
                                            </div>
                                        </div>
                                        <form id="handleDonate" name="handleDonate" class="md-float-material form-material"  method="POST" action="javascript:void(0)">
                                        <div class="row seacrh-header">
                                            <div class="col-lg-4 offset-lg-4 offset-sm-3 col-sm-6 offset-sm-1 col-xs-12">
                                                <div class="input-group input-group-button input-group-primary">
                                                    <input type="text" class="form-control" id="d_amou" name="d_amou" placeholder="Cuanto Dinero deseas donar.">
                                                    <button type="submit" class="btn btn-primary input-group-addon" id="basic-addon1">Donativo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xl-12 col-md-12">
                                
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>