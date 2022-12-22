<div class="pcoded-wrapper">
	<div class="pcoded-content">
		<div class="pcoded-inner-content">
			<div class="main-body">
				
				<div class="page-wrapper">
					<div class="page-body m-t-50">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="cover-profile">
                                    <div class="profile-bg-img">
                                        <img class="profile-bg-img img-fluid" src="{{ asset('src/images/country/ve.png') }}" alt="bg-img">
                                        <div class="card-block user-info">
                                            <div class="col-md-12">
                                                <div class="media-left">
                                                    <a href="#" class="profile-image">
                                                        <img class="user-img img-radius" src="{{ asset('src/icon/avatar.jpg') }}" alt="user-img">
                                                    </a>
                                                </div>
                                                <div class="media-body row">
                                                    <div class="col-lg-12">
                                                        <div class="user-title">
                                                            <h2>{{ Auth::User()->name }}</h2>
                                                        </div>
                                                    </div>
                                                    <div>
                                                        <div class="pull-right cover-btn">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="tab-header card">
                                    <ul class="nav nav-tabs md-tabs tab-timeline" role="tablist" id="mytab">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#personal" role="tab">Informaci&oacute;n</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#cards" role="tab">Tarjetas de Cr&eacute;dito</a>
                                            <div class="slide"></div>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#accounts" role="tab">Cuentas de Banco</a>
                                            <div class="slide"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="personal" role="tabpanel">
                                        @include('page.clients.profile.information')
                                    </div>
                                    <div class="tab-pane" id="cards" role="tabpanel">
                                        @include('page.clients.profile.creditcard')
                                    </div>
                                    <div class="tab-pane" id="accounts" role="tabpanel">
                                        @include('page.clients.profile.accountbank')

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