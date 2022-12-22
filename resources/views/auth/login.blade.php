@extends('layouts.app')

@section('content')

<section class="login-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <form class="md-float-material form-material" method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="text-center">
                        <img src="{{ asset('src/icon/logicon.png') }}" alt="logo.png">
                    </div>
                    <div class="auth-box card">
                        <div class="card-block">
                            <div class="row m-b-20">
                                <div class="col-md-6">
                                    <a href="https://www.facebook.com/boomsolutionsve" class="btn btn-facebook m-b-20 btn-block"><i class="icofont icofont-social-facebook"></i>facebook</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="https://www.instagram.com/boomsolutionsve/" class="btn btn-instagram m-b-20 btn-block"><i class="icofont icofont-social-instagram"></i>instagram</a>
                                </div>
                            </div>
                            <p class="text-muted text-center p-b-5">Ingrese su usuario y contrase&ntilde;a</p>
                            <div class="form-group form-primary">
                                <input type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" id="username" value="{{ old('username') }}" required autofocus placeholder="Username">
                                <span class="form-bar"></span>
                                @if ($errors->has('username'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group form-primary">
                                <input  type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="Password">
                                <span class="form-bar"></span>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="row m-t-25 text-left">
                                <div class="col-12">
                                    <div class="checkbox-fade fade-in-primary">
                                        <label>
                                            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                            <span class="cr"><i class="cr-icon icofont icofont-ui-check txt-primary"></i></span>
                                            <label class="text-inverse" for="remember">
                                                {{ __('Recordarme') }}
                                            </label>


                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row m-t-10">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-primary btn-md btn-block waves-effect text-center m-b-20">{{ __('Login') }}</button>
                                </div>
                            </div>
                            <p class="text-center">Copyright &copy; <?php echo date("Y"); ?> <strong>Boom Solutions - Venezuela</strong>, All rights reserved.</p>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>



@endsection
