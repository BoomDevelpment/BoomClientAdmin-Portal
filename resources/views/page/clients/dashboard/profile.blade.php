<div class="col-xl-8 col-md-12">
    <div class="card user-card-full">
        <div class="row m-l-0 m-r-0">
            <div class="col-sm-4 bg-c-lite-green user-profile">
                <div class="card-block text-center text-white">
                    <div class="m-b-25">
                        <img src="{{ asset('src/icon/avatar.jpg') }}" class="img-radius" alt="User-Profile-Image">
                    </div>
                    <h6 class="f-w-600">{{ $cli->name }}</h6>

                    <ul class="social-link list-unstyled m-t-40 m-b-10">
                        @if ($cli->facebook == '')
                            <li><a href="https://www.facebook.com/boomsolutionsve/" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook"><i class="feather icon-facebook facebook" aria-hidden="true"></i></a></li>	
                        @else
                            <li><a href="https://www.facebook.com/{{ $cli->facebook }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="facebook"><i class="feather icon-facebook facebook" aria-hidden="true"></i></a></li>	
                        @endif()

                        @if ($cli->instagram == '')
                            <li><a href="https://www.instagram.com/boomsolutionsve/" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram"><i class="feather icon-instagram instagram" aria-hidden="true"></i></a></li>	
                        @else
                            <li><a href="https://www.instagram.com/{{ $cli->instagram }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="instagram"><i class="feather icon-instagram instagram" aria-hidden="true"></i></a></li>	
                        @endif()

                        @if ($cli->twitter == '')
                            <li><a href="https://www.twitter.com/boomsolutionsve/" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter"><i class="feather icon-twitter twitter" aria-hidden="true"></i></a></li>	
                        @else
                            <li><a href="https://www.twitter.com/{{ $cli->twitter }}" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="twitter"><i class="feather icon-twitter twitter" aria-hidden="true"></i></a></li>	
                        @endif()
                    </ul>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card-block">
                    <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Datos del cliente</h6>
                    <div class="row">
                        <div class="col-sm-12">
                            <p class="m-b-10 f-w-600">Direcci&oacute;n</p>
                            <h6 class="text-muted f-w-400">{{ $cli->address }}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Tel&eacute;fono Fijo</p>
                            <h6 class="text-muted f-w-400">{{ $cli->phone_principal }}</h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Tel&eacute;fono Movil</p>
                            <h6 class="text-muted f-w-400">{{ $cli->phone_alternative }}</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Email Principal</p>
                            <h6 class="text-muted f-w-400">{{ $cli->email_principal }}</h6>
                        </div>
                        <div class="col-sm-6">
                            <p class="m-b-10 f-w-600">Email Secundario</p>
                            <h6 class="text-muted f-w-400">{{ $cli->email_alternative }}</h6>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/profile') }}" class="btn btn-warning btn-block p-t-15 p-b-15">
                    Editar Perfil
                </a>
                <br>
            </div>
        </div>
    </div>
</div>