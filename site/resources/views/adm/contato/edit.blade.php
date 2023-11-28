@extends('adm.template.layout')
@section('title', 'Contatos - Editar')

@section('content')
    @include('adm.includes.error')

    <div class="content">
        <form action="{{ route('contato.update', $contato->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label class="form-label" for="title">Nome</label>
                <input class="form-control" type="text" name="title" value="{{ $contato->title }}" placeholder="Digite seu nome">

            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="email">E-mail</label>
                        <input class="form-control" type="email" value="{{ $contato->email }}" name="email" placeholder="Digite seu e-mail">
                    </div>
                    <div class="col">
                        <label class="form-label" for="telefone">Telefone</label>
                        <input class="form-control" type="text" value="{{ $contato->telephone }}" id="tel" name="telephone" placeholder="Digite seu número de telefone">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="text">Resumo:</label>
                <textarea class="form-control" id="textarea" rows="3" name="text" maxlength="255">{{ $contato->text }}</textarea>
                <span id="rchars" class="form-text">{{ 255 - strlen($contato->text) }}</span><span class="form-text"> Caracteres restantes</span>
            </div>

            <br>
            <div class="group-button">
                <input class="btn btn-success" type="submit" value="Salvar">
                <a href="{{ route('contato.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    @include('adm.contato.scripts')
@endsection
