@extends('adm.template.layout')
@section('title', 'Meu perfil')
    
@section('head')
    <link rel="stylesheet" href="{{ asset('css/adm/perfil.css') }}">
@endsection

@section('content')
<div class="content">
    <div class="content-form-perfil">
        <form action="{{ route('perfil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group form-header">
                <img src="{{ asset('upload/perfil/'.$perfil->image) }}" id="uploadImg" alt="">
                <div class="group-buttons">
                    <input type="file" class="form-control-file" name="image" id="uploadImage" onchange="PreviewImage()">
                    <label for="uploadImage"><i class="fa-solid fa-arrow-up-from-bracket"></i> Escolha uma imagem</label>


                    @if($perfil->image != "user.png")
                        <button type="button" class="deleteImage" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="fa-solid fa-trash"></i> Excluir imagem
                        </button>

                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deletar imagem de perfil</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Deseja deletar a imagem?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <a href="{{ route('perfil.delete-image') }}" type="submit" class="btn btn-outline-danger">Deletar</a>
                                </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome"
                value="{{ $perfil->name }}">
            </div>
            <div class="form-group">
                <label for="usuario">Usuário</label>
                <input type="text" class="form-control" id="usuario" name="usuario" placeholder="Digite seu usuário"
                value="{{ $perfil->username }}">
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Digite seu e-mail"
                value="{{ $perfil->email }}">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <label for="senha">Senha</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite uma nova senha">
            </div>
            <div class="form-group">
                <label for="confirmar">Confirme sua senha</label>
                <input type="password" class="form-control" id="confirmar" name="confirmar" placeholder="Confirme sua nova senha">
            </div>
            <button type="submit" class="btn btn-success">Alterar</button>
        </form>
    </div>
</div>

<script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
<script>
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadImg").src = oFREvent.target.result;
            $('#uploadImg').css('opacity', 1);
            $('#uploadImg').css('display', 'initial');
        };
    };
</script>
@endsection