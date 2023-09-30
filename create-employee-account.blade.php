<!doctype html>
<html class="no-js" lang="es-MX" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('signin.sign_in') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Favicons -->
    <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.ico') }}" type="image/x-icon">
    <link href="{{ asset('css/foundation_old/foundation.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ URL::asset('css/login.css') }}?v={{ time() }} ">
    <script src="{{ asset('js/create-emp-account.js') }}" defer></script>


</head>

<body style="background-color:#e7e8e7; margin: auto; padding: auto;">
    <div class="login-div text-center d-flex align-items-center"
        style="display: flex;flex-direction: column;align-items: flex-start;background-color:#e7e8e7;">
        <div class="login-container"
            style="align-self: center;background-color:white; width:400px;height:530px; border-radius:6%;">
            <div class="jb-mt-40">
                <img src="{{ URL::asset('assets/img/logo.png') }}" style="width: 40%; display: block; margin: 0 auto;">
            </div>
            <br>
            <div class="row margin-8-top">
                <div class="large-10 large-centered columns">
                    <div id="p_sign_in" class="lblLogin optSel optSelect" style="width: 200px;">
                    </div>

                    <form id="formLogin" data-abide novalidate autocomplete="off" data-abide method="POST"
                    class="padding-8-top" action="{{ route('authenticate') }}">
                    <!-- ... your existing form content ... -->
                    <div>
                        <input id="password" type="password" class="form-control" name="password"
                            value="" required autocomplete="new-password" placeholder="Crear contraseña">
                        <input id="passwordConfirmation" type="password" class="form-control" name="password_confirmation"
                            value="" required autocomplete="new-password" placeholder="Repite la contraseña">
                        <div id="passwordError" style="color: red; display: none;">
                            Por favor intenta de nuevo, la contraseña no coincide
                        </div>
                    </div>
                    <div>
                    </div>
                    <button id="botonConfirmar" class="button expanded btnLogin" style="" type="button">Confirmar</button>
                </form>

                </div>
            </div>
            <div class="row margin-4-top login-footer">
            </div>

        </div>
    </div>
    <footer>
        <div id="footer">
        </div>
    </footer>

    <script src="{{ URL::asset('dependency/js/foundation/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('dependency/js/foundation/foundation.min.js') }}"></script>
    <script type="text/javascript">
        $(document).foundation();
        // var HOST = "{{ URL::to('/') }}";
        // var _URL_W_RESET = HOST + '/passreset/remind';
        // var _URL_M_RESET = HOST + '/resetpassword/';
        // var __late = {
        //     wait_a_momment: '{{ __('global.loading.wait_a_momment') }}',
        //     check_email_password: '{{ __('password.check_email_password') }}',
        // }
    </script>
</body>

</html>
