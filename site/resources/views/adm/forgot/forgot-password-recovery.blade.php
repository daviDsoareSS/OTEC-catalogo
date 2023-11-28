<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - Recuperar senha</title>
    <link rel="stylesheet" href="{{ asset('css/adm/login.css') }}">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@200;400;600;800&display=swap');
    </style>
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

    <form class="form-login" method="post" action="{{ route('forgot.email') }}">
        @csrf
        <div class="group-header">
            <img class="mb-4 logo-user" src="{{ asset('img/andrea.JPG')}}" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Recuperação de senha</h1>
        </div>
        <div class="form-group form-floating mb-3">
            <label class="form-text" for="email">Informe o e-mail para o qual deseja redefinir a senha.</label>
            <input type="email" class="form-control" name="email" placeholder="E-mail" required autofocus>
        </div>
        <div class="group-footer">
            <button class="w-100 btn btn-lg btn-primary " type="submit">Redefinir senha</button>
            <p><a href="{{ route('login.show') }}"> Fazer login</a></p>
        </div>
    </form>
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/color-thief/2.3.0/color-thief.umd.js"></script>

<script>
    const waves = document.querySelector('.waves')
    const colorThief = new ColorThief();
    const img = document.querySelector('.logo-user');
    // Make sure image is finished loading

    if (img.complete) {
      const cor = colorThief.getColor(img);

    } else {
        img.addEventListener('load', function() {
            const cor = colorThief.getColor(img);
            const r = cor[0];
            const g = cor[1];
            const b = cor[2];
            const corPredominante = 'rgb(' + r + ', ' + g + ', ' + b + ')';

            waves.style.fill = corPredominante
        });
    }
    const messageContent = document.querySelector('.message');

    function ocultMessageContent(){
        messageContent.style.top = '-50%';
        messageContent.style.opacity = 0;

    }
    setTimeout(ocultMessageContent, 3000);


</script>
</html>
