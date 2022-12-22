<div class="col-xl-3 col-md-6">
    <div class="card bg-c-pink update-card">
        <div class="card-block">
            <div class="row align-items-end">
                <div class="col-8">
                    <h4 class="text-white">$ 19.99</h4>
                    <h6 class="text-white m-b-0">Total de Facturas</h6>
                </div>
                <div class="col-4 text-right">
                    <i class="ti-clipboard f-50"></i>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('/invoices') }}" class="button">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">Ver mas</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-c-green update-card">
        <div class="card-block">
            <div class="row align-items-end">
                <div class="col-8">
                    <h4 class="text-white">3</h4>
                    <h6 class="text-white m-b-0">Servicio al Cliente</h6>
                </div>
                <div class="col-4 text-right">
                    <i class="ti-email f-50"></i>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('/customers') }}" class="button">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">Ver mas</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-c-yellow update-card">
        <div class="card-block">
            <div class="row align-items-end">
                <div class="col-8">
                    <h4 class="text-white">1</h4>
                    <h6 class="text-white m-b-0">Ticket sin leer</h6>
                </div>
                <div class="col-4 text-right">
                    <i class="feather icon-file-text f-50"></i>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('/tickets') }}" class="button">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">Ver mas</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
<div class="col-xl-3 col-md-6">
    <div class="card bg-c-lite-green update-card">
        <div class="card-block">
            <div class="row align-items-end">
                <div class="col-8">
                    <h4 class="text-white">$ {{ $wallet }}</h4>
                    <h6 class="text-white m-b-0">Billetera Digital</h6>
                </div>
                <div class="col-4 text-right">
                    <i class="ti-wallet f-50"></i>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ url('/wallet') }}" class="button">
                <div class="row align-items-center">
                    <div class="col-9">
                        <p class="text-white m-b-0">Ver mas</p>
                    </div>
                    <div class="col-3 text-right">
                        <i class="feather icon-trending-up text-white f-16"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>