<header>
    <div class="btnMobile">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <div class="title-page">
        @if(stripos(request()->route()->getName(), 'index') === false)
            <a href="{{ redirect()->back()->getTargetUrl() }}">
                <h1>
                    <i class="fa-solid fa-circle-arrow-left"></i>
                    @yield('title')
                </h1>
            </a>
        @else
            <h1>
                <i class="fa-solid fa-house-chimney"></i>
                @yield('title')
            </h1>
        @endif
    </div>
    <ul class="links-header">
        <li class="link option-notification" id="li">
            <i class="fa-solid fa-bell notifications"></i>

            @if(count($notificacaoLeads) > 0)
                <span class="badge badge-danger navbar-badge-news" id="leadscount">
                    {{ count($notificacaoLeads) }}
                </span>
            @endif

            <div class="options-collapsed notifications" id="linkleadsNotifications">
                @foreach ($notificacaoLeads as $lead)
                    <a href="{{ route('leads.edit', $lead->id) }}" class="media-link">
                        <div class="media">
                            <div class="text">
                                <h4 class="media-titulo">{{ $lead->title }}</h4>
                                <span class="telefone">{{ $lead->telephone }}</span><br>
                                <span class="time"><i class="fa-regular fa-clock"></i> {{ runningTime($lead['created_at']) }}</span>
                            </div>
                        </div>
                    </a>
                    <hr>
                @endforeach

                @if(!$notificacaoLeads)
                    <p>Nada encontrado.</p>
                @else
                    <div class="total-news">
                        <a href="{{ route('leads.index') }}"><p>Veja todas as news</p></a>
                    </div>
                @endif
            </div>
        </li>
        <li class="link option-notification">
        <i class="fa-solid fa-message"></i>
            @if(count($notificacaoContatos) > 0)
                <span class="badge badge-danger navbar-badge-contato" id="contatocount">
                    {{ count($notificacaoContatos) }}
                </span>
            @endif

            <div class="options-collapsed notifications" id="linkContatoNotifications">
                @foreach ($notificacaoContatos as $contato)
                    <a href="{{ route('contato.edit', $contato->id) }}" class="media-link">
                        <div class="media">
                            <div class="text">
                                <h4 class="media-titulo">{{ $contato->title }}</h4>
                                <span class="telefone">{{ $contato->telephone }}</span><br>
                                <span class="time"><i class="fa-regular fa-clock"></i> {{ runningTime($contato['created_at']) }}</span>
                            </div>
                        </div>
                    </a>
                    <hr>
                @endforeach

                @if(!$notificacaoContatos)
                    <p>Nada encontrado.</p>
                @else
                    <div class="total-news">
                        <a href="{{ route('contato.index') }}"><p>Veja todos os contatos</p></a>
                    </div>
                @endif
            </div>
        </li>
        <li class="link">
            <i class="fa-solid fa-circle-half-stroke"></i>
            <div class="options-collapsed colors">
                <ul>
                    <li class="dark-mode-toggle"><i class="fa-solid fa-moon"></i>Modo escuro</li>
                    <li class="white-mode-toggle"><i class="fa-solid fa-sun"></i>Modo claro</li>
                </ul>
            </div>
        </li>
        <li class="wrapper-user">
            <a href="{{ route('perfil.index') }}"><img src="{{ asset('upload/perfil/'.$user->image) }}" alt=""></a>
            <li class="link">
                <p id="name-client">{{ $user->name }}</p>
                <i class="fa-solid fa-caret-down"></i>
                <div class="options-collapsed more-options">
                    <ul>
                        <a href="{{ route('perfil.index') }}"><li>Perfil</li></a>
                        <a href="{{ route('logout.perform') }}"><li>Sair</li></a>
                    </ul>
                </div>
            </li>
        </li>
    </ul>
</header>

<script>
    const linksHeader = document.querySelectorAll('.links-header .link');
    let openLink = null;

    linksHeader.forEach(function (link) {
        link.addEventListener('click', function () {
            if (openLink && openLink !== link) {
                openLink.classList.remove('collapsed');
            }

            if (link.classList.contains('collapsed')) {
                link.classList.remove('collapsed');
                openLink = null;
            } else {
                link.classList.add('collapsed');
                openLink = link;
            }
            event.stopPropagation();
        });
    });

    document.addEventListener('click', function (event) {
        const isOutsideCollapsed = !event.target.closest('.options-collapsed');

        if (isOutsideCollapsed && openLink) {
            openLink.classList.remove('collapsed');
            openLink = null;
        }
    });

</script>
