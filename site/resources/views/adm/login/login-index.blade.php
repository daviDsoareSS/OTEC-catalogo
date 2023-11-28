<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/adm/app.css')}}">
    <link rel="stylesheet" href="{{ asset('css/adm/login.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600;800&display=swap');
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.min.js"></script>

</head>
<body>
    <svg 
        class="waves" 
        xmlns="http://www.w3.org/2000/svg" 
        viewBox="0 0 1440 320">
        <path 
            fill-opacity="1" 
            d="M0,64L40,85.3C80,107,160,149,240,170.7C320,192,400,192,480,208C560,224,640,256,720,261.3C800,267,880,245,960,224C1040,203,1120,181,1200,176C1280,171,1360,181,1400,186.7L1440,192L1440,320L1400,320C1360,320,1280,320,1200,320C1120,320,1040,320,960,320C880,320,800,320,720,320C640,320,560,320,480,320C400,320,320,320,240,320C160,320,80,320,40,320L0,320Z">
        </path>
    </svg>

    @if($errors->any())
        <div class="message message-delete">
            <p><i class="fa-solid fa-check"></i>{!! implode('', $errors->all('<div>:message</div>')) !!}<p>
        </div>
    @endif

    <form class="form-login" method="post" action="{{ route('login.perform') }}">
        <div class="group-header">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <img class="mb-4 logo-user" src="{{ asset('upload/perfil/'.$user->image) }}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Login</h1>
        </div>

        <div class="form-group form-floating mb-3">
            <input type="text" class="form-control" name="username" value="{{ old('username') }}" placeholder="Usuário" required="required" autofocus>
            @if ($errors->has('username'))
                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
            @endif
        </div>
        
        <div class="form-group form-floating mb-3">
            <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Senha" required="required">
            @if ($errors->has('password'))
                <span class="text-danger text-left">{{ $errors->first('password') }}</span>
            @endif
        </div>
        <div class="group-footer">
            <button class="w-100 btn btn-lg btn-primary btn-login" type="submit">Login</button>
            <p><a href="{{ route('forget.password-recovery') }}"> Esqueceu a senha?</a></p>
        </div>
        
    </form>
    
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script> --}}
    <script>
        const waves = document.querySelector('.waves');
        const img = document.querySelector('.logo-user');
        const btnLogin = document.querySelector('.btn-login');
        const colorThief = new ColorThief();

        img.addEventListener('load', () => {
            const color = colorThief.getColor(img);
            const rgbColor = `rgb(${color[0]}, ${color[1]}, ${color[2]})`;
            waves.style.fill = rgbColor;
            btnLogin.style.backgroundColor = rgbColor;
            document.documentElement.style.setProperty('--primary-color', rgbColor);
        });
    </script>
    <style>
        :root {
            --primary-color: #000000; /* Default color */
        }
    </style>
</body>
</html>
