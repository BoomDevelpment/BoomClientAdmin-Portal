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
                                                <p class="txt-highlight text-center m-t-20">Para cambiar tu tickets, utiliza la siguiente accion
                                                </p>
                                            </div>
                                        </div>
                                        <form id="handleTicket" name="handleTicket" class="md-float-material form-material"  method="POST" action="javascript:void(0)">
                                        <div class="row seacrh-header">
                                            <div class="col-lg-4 offset-lg-4 offset-sm-3 col-sm-6 offset-sm-1 col-xs-12">
                                                <div class="input-group input-group-button input-group-primary">
                                                    <input type="text" class="form-control" id="t_id" name="t_id" placeholder="Colca tu ticket aqui!">
                                                    <button type="submit" class="btn btn-primary input-group-addon" id="basic-addon1">Canjea</button>
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
                                
                                <h4 class="m-b-20"><b>{{ $c }}</b> Resultados Obtenidos</h4>
                                <div class="row search-result">
                                    @if ($c > 0)
                                        @foreach($inf as $i)
                                            <div class="col-lg-3 col-md-4 col-sm-6 ">
                                                <div class="card">
                                                    @if ($i['status'] == 0)
                                                        <a href="javascript:;" onclick="ChangeTicket( {{ $i['id'] }} )">
                                                            <img class="card-img-top img-fluid" src="{{ asset('src/images/donative/banner.png') }}" alt="Card image cap">
                                                            <div class="card-block">
                                                                <h6 class="card-title" style="text-align: center;"><strong>{{ $i['title'] }} </strong></h6>
                                                                <p class="card-text text-muted" style="text-align: justify;">{{ $i['message'] }}</p>
                                                                <p class="card-text text-muted" style="text-align: justify;">Ticket: <strong>{{ $i['ticket'] }}</strong> - Total:  <strong>$ {{ $i['amount'] }}</strong></p><br>
                                                                <div class="card bg-c-yellow text-white widget-visitor-card" style="margin-bottom: 0px;">
                                                                    <div class="card-block-small text-center" style="padding-top: 0px; padding-bottom: 0px;">
                                                                        <h3>Canjear</h3>
                                                                        <i class="feather icon-award" style="font-size: 50px;"></i>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </a>                                                        
                                                    @else

                                                        <img class="card-img-top img-fluid" src="{{ asset('src/images/donative/banner.png') }}" alt="Card image cap">
                                                        <div class="card-block">
                                                            <h6 class="card-title" style="text-align: center;"><strong>{{ $i['title'] }} </strong></h6>
                                                            <p class="card-text text-muted" style="text-align: justify;">{{ $i['message'] }}</p>
                                                            <p class="card-text text-muted" style="text-align: justify;">Total:  <strong>$ {{ $i['amount'] }}</strong></p><br>
                                                            <div class="card bg-c-blue text-white widget-visitor-card" style="margin-bottom: 0px;">
                                                                <div class="card-block-small text-center" style="padding-top: 0px; padding-bottom: 0px;">
                                                                    <h3>Utilizado</h3>
                                                                    <i class="feather icon-user" style="font-size: 50px;"></i>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif()

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>