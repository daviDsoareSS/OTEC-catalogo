<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | {{ getItem('client')}}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('favicon/site.webmanifest') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style-popup.css') }}">

    {{-- META TAGS (SEO) --}}
    <meta name="Title" content="@yield('title-seo')">
    <meta name="Author" content="{{ getItem('client')}}">
    <meta name="description" content="@yield('description-seo')">
    <meta name="keywords" content="@yield('keywords-seo')">

    {{-- META TAGS(OPEN GRAPH)     --}}
    <meta property="og:title" content="@yield('title-seo')"/>
    <meta property="og:type" content=""/>
    <meta property="og:description" content="@yield('description-seo')"/>
    <meta property="og:image" content="{{ url('favicon/favicon-32x32.png') }}"/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta name="twitter:card" content="">
    <meta property="twitter:url" content=""/>
    <meta property="twitter:title" content="@yield('title-seo')"/>
    <meta name="twitter:description" content="@yield('description-seo')">
    <meta property="twitter:image" content="{{ url('favicon/favicon-32x32.png') }}"/>

    @yield('head')
</head>
<body>
    <!--Popup Lgpd-->
    <div class="pop-up-cookie" id="popup">
        <div class="content-wrapper">
            <p>Utilizamos cookies para você obter a melhor experiência em nosso site. Ao continuar navegando, você concorda com a nossa <a href="{{ url('/termos') }}">Política de Privacidade</a>.</p>
            <a href="javascript:;" itemprop="url" class="btn-privacy" id="privacy-ok">OK</a>
        </div>
    </div> 

     <a href="{{ getItem('link-whats1') }}" target="_blank">
        <div class="btn-whats">
            <img src="{{ asset('img/whatsapp.png')}}" alt="WhatsApp">      
        </div>
    </a>

    @include('includes.header')
    <!--Modal sair-->
    <div id="modal-exit" class="all-modal">
        <div class="underlay"></div>
        <div class="modal">
            <i class="fa-solid fa-xmark icon-close-popup"></i>
            <div class="modal-content">
                <form action="{{ route('lead-submit') }}" id="popup-exit" method="post">
                    @csrf
                    <img src="{{ asset('img/logo-Dra. Natalli Landi.webp')}}" alt="">
                    <span>Você encontrou o que precisava?</span>
                    <input type="text" style="padding: 13px !important;" required placeholder="Nome" class="form-control @error('nome') is-invalid @enderror" name="nome" id="nome">
                    <input type="text" style="padding: 13px !important;" required placeholder="WhatsApp" class="whatsappModalSair form-control @error('Whatsapp') is-invalid @enderror" name="whatsapp" maxlength="15" id="whatsappModalSair">

                    <input type="text" style="height:0;border:0;outline:0;margin:0;position:absolute;padding:0;min-height:unset;" name="codigo" placeholder="Código"  autocomplete = “off”  maxlength="80">

                    <div class="terms">
                        <input type="checkbox" required name="checkbox" id="termosPopup">
                        <label for="termosPopup">Concordo com os <a href="{{ route('termos') }}">termos de uso</a> e <a href="{{ route('termos') }}">privacidade</a> da <strong>{{ getItem('client') }}</strong>.</label>
                    </div>
                    <button>Enviar</button>
                </form>
            </div>
        </div>
    </div>

    @if(session()->has('success'))
    <div class="message message-success" id="message-success">
        <p><i class="fa-solid fa-check"></i> {{ session()->get('success') }}</p>
    </div>
    @endif

    @if(session()->has('error'))
        <div class="message message-error">
            <p><i class="fa-solid fa-check"></i> {{ session()->get('error') }}<p>
        </div>
    @endif
    
    @include('includes.faixa-header')

    <section class="section-especialidades">
        <div class="content">
            <div class="wrapper-especialidades">
                <a href="{{ route('estetica-corporal') }}">
                    <div class="{{ url()->current() === url('/especialidades/estetica-corporal') ? 'card selected' : 'card' }}">
                        <img src="{{ asset('img/pagHome/card-1.webp') }}" alt="">
                        <h3>Estética corporal</h3>
                        <p>Saiba +</p>
                    </div>
                </a>
                <a href="{{ route('estetica-facial') }}">
                    <div class="{{ url()->current() === url('/especialidades/estetica-facial') ? 'card selected' : 'card' }}">
                        <img src="{{ asset('img/pagHome/card-2.webp') }}" alt="">
                        <h3>Estética facial</h3>
                        <p>Saiba +</p>
                    </div>
                </a>
                <a href="{{ route('capilares') }}">
                    <div class="{{ url()->current() === url('/especialidades/capilares') ? 'card selected' : 'card' }}">
                        <img src="{{ asset('img/pagHome/card-3.webp') }}" alt="">
                        <h3>Capilares</h3>
                        <p>Saiba +</p>
                    </div>
                </a>
                <a href="{{ route('procedimentos') }}">
                    <div class="{{ url()->current() === url('/especialidades/procedimentos') ? 'card selected' : 'card' }}">
                        <img src="{{ asset('img/pagHome/card-4.webp') }}" alt="">
                        <h3>Procedimentos</h3>
                        <p>Saiba +</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
    @yield('content')
    
    @include('includes.footer')
    
    @yield('scripts')
    <script src="{{ asset('js/script-popup-saida.js') }}"></script>
    <script src="https://kit.fontawesome.com/639efb6961.js" crossorigin="anonymous"></script>
    <script>
        function ocultMessageContent(message){
            message.style.opacity = 0;
            message.style.display = 'none';
        }
        setTimeout(function() {
            var successMessage = document.getElementById('message-success');
            ocultMessageContent(successMessage);
        }, 3500);
    </script>

</body>

</html>