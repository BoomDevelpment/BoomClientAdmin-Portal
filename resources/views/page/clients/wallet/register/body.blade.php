<br>
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
                                    <div class="row m-b-30">
                                        <div class="col-lg-12 col-xl-12">
                                            <ul class="nav nav-tabs md-tabs" role="tablist">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab" href="#zelle" role="tab">Zelle</a>
                                                    <div class="slide"></div>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#paypal" role="tab">Paypal</a>
                                                    <div class="slide"></div>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#transference" role="tab">Transferecias Bancarias</a>
                                                    <div class="slide"></div>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab" href="#movil" role="tab">Pago Movil</a>
                                                    <div class="slide"></div>
                                                </li>
                                            </ul>
                                            <!-- Tab panes -->
                                            <div class="tab-content card-block">
                                                <div class="tab-pane active" id="zelle" role="tabpanel">
                                                    @include('page.clients.wallet.register.zelle')
                                                </div>
                                                <div class="tab-pane" id="paypal" role="tabpanel">
                                                    @include('page.clients.wallet.register.paypal')
                                                </div>
                                                <div class="tab-pane" id="transference" role="tabpanel">
                                                    @include('page.clients.wallet.register.transference')
                                                </div>
                                                <div class="tab-pane " id="movil" role="tabpanel">
                                                    @include('page.clients.wallet.register.movil')
                                                </div>
                                            </div>
                                            <!-- End Tab panes -->
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