@extends('adm.template.layout')
@section('title', 'Leads - Criar')

@section('content')

    @include('adm.includes.error')

    <div class="content">
        <form action="{{ route('leads.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label" for="title">Nome</label>
                <input class="form-control" type="text" name="title" id="title" placeholder="Digite seu nome">
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="telefone">Telefone</label>
                        <input class="form-control" type="text" id="tel" name="telephone" placeholder="Digite seu número de telefone">
                    </div>
                </div>
            </div>

            <br>
            <div class="group-button">
                <input class="btn btn-success" type="submit" value="Salvar">
                <a href="{{ route('leads.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection
@section('scripts')
    @include('adm.leads.script')

@endsection
