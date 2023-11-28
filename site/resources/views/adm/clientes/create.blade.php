@extends('adm.template.layout')
@section('title', 'Clientes - Criar')

@section('content')
    @include('adm.includes.error')

    <div class="content">
        <form action="{{ route('clientes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="title">Nome</label>
                        <input class="form-control" type="text" name="nome" placeholder="Digite o nome do cliente" required>
                    </div>
                    <div class="col">
                        <label class="form-label" for="title">CPF</label>
                        <input class="form-control" type="text" name="cpf" placeholder="Digite o CPF do cliente" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="email">E-mail</label>
                        <input class="form-control" type="email" name="email" placeholder="Digite e-mail do cliente" required>
                    </div>
                    <div class="col">
                        <label class="form-label" for="telefone">Telefone</label>
                        <input class="form-control" type="text" id="telefone" name="telefone" placeholder="Digite o número de telefone do cliente" required>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <label class="form-label" for="telefone">CEP</label>
                        <input class="form-control" type="text" id="cep" name="cep" placeholder="Digite o cep de telefone do cliente" required>
                    </div>
                    <div class="col">
                        <label class="form-label" for="telefone">Endereço</label>
                        <input class="form-control" type="text" id="endereco" name="endereco" placeholder="Digite o endereço do cliente" required>
                    </div>
                    <div class="col">
                        <label class="form-label" for="telefone">UF</label>
                        <input class="form-control" type="text" id="uf" name="uf" placeholder="Digite o UF do cliente" required>
                    </div>
                    <div class="col">
                        <label class="form-label" for="telefone">UF</label>
                        <input class="form-control" type="text" id="uf" name="uf" placeholder="Digite o UF do cliente" required>
                    </div>
                </div>
            </div>

            <br>
            <div class="group-button">
                <input class="btn btn-success" type="submit" value="Salvar">
                <a href="{{ route('clientes.index') }}" class="btn btn-primary">Voltar</a>
            </div>
        </form>
    </div>

@endsection

@section('scripts')
    @include('adm.contato.scripts')
@endsection
