@extends('adm.template.layout')
@section('title', 'Página principal')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/adm/home.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content-welcome-user">
        <div class="content-top left">
            <h1>Olá {{ $user->name }}!</h1>
            <p>Seja bem-vindo, essa é sua página de administrador.</p>
        </div>
        <div class="content-top right">
            <h1>Publicações</h1>
            <p id="publicacoes"></p>
        </div>
    </div>
    <div class="welcome-text">
        <h3>Introdução</h3>
        <p>
            Nesta plataforma, você terá acesso a um conjunto de ferramentas e recursos projetados para facilitar a gestão eficiente de diversos aspectos do seu site.
            <br><br>
            Nossa área administrativa foi desenvolvida com muito carinho para atender as suas necessidades específicas, conforme acordado previamente em seu contrato/proposta.
            <br><br>
            Projetada para ser fácil de usar, mesmo para usuários sem conhecimentos técnicos, apresenta uma interface intuitiva e recursos de arrastar e soltar, navegando sem esforço pelas diferentes seções e funcionalidades para aproveitar todas as ferramentas contratadas e como cortesias.
            <br><br>
            Você pode gerenciar conteúdos, acompanhar possíveis leads e ainda ter um cadastro básico de clientes, em único local. Com apenas alguns cliques, crie novas postagens, adicionando imagens e formatando o texto de acordo com seus objetivos. Além disso, nosso painel permite que você faça edições rápidas e atualizações em postagens existentes, garantindo que seu conteúdo esteja sempre atualizado e relevante.
            <br><br>
            Se precisar de ajuda, <a href="https://api.whatsapp.com/send?phone=551120911990">fale com a gente!</a>
            <br><br>
            Cuide de seu site!
            <br><br>
            SUCESSO!
            <br><br>
            <strong>Engenho de Imagens</strong>
        </p>
    </div>
</div>

<script>
    // Obtém a referência para o elemento do contador
    let contadorPublicacao = document.getElementById("publicacoes");

    let contadorContatos = document.getElementById("contatos");

    // Define o número final desejado para o contador
    let numeroFinal = {{ $acompanhelist }};

    // Inicializa o contador
    let contador = 0;

    // Função para atualizar o contador na tela
    function atualizarContador() {
        contadorPublicacao.innerText = contador + ' publicações';
    }

    // Função para animar o contador
    function animarContador() {
        // Verifica se o contador atingiu o número final
        atualizarContador();
        if (contador < numeroFinal) {
            contador += 1;
            atualizarContador();
            setTimeout(animarContador, 600);
        }
    }

    // Inicia a animação do contador
    animarContador();

</script>

@endsection
