@extends('adm.template.layout')
@section('title', 'Leads')
@section('content')
    @include('adm.includes.messages')

    <div class="content">
        <div class="info">
            <div class="row">
                <div class="col">
                    <a href="{{ route('leads.create') }}" class="btn btn-success btn-create"><span>Cadastrar  </span><i class="fa-solid fa-plus"></i></a>
                    <button class="btn btn-delete" data-bs-toggle="modal" data-bs-target="#delete-all" onclick="sendSelecteds()"></button>
                    <div class="modal fade" id="delete-all" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja deletar os itens selecionados?</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <p class="text"></p>
                                    <ul></ul>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                    <button id="btn-delete-all" class="btn btn-outline-danger" data-item-id="">Deletar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="table">
                <table id="example" class="table-acompanhe">
                    <thead>
                        <tr>
                            <th>Selecione</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Data e hora</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($leads as $lead)
                            <tr>
                                <td data-title="Selecione" class="checkbox-items">
                                    <input type="checkbox" value="{{ $lead->id }}">
                                </td>
                                <td class="title"><a href="{{ route('leads.edit', $lead->id) }}">{{ $lead->title }}</a></td>
                                <td data-title="Telefone"><a href="{{ route('leads.edit', $lead->id) }}">{{ $lead->telephone }}</a></td>
                                <td data-title="Data"><a href="{{ route('leads.edit', $lead->id) }}">{{ $lead->date }} - {{ $lead->time }}</a></td>
                                <td data-title="Status" class="{{ $lead->status == 'lido' ? 'lido' : 'nao-lido' }}">
                                    <a href="{{ route('leads.edit', $lead->id) }}">
                                    {{ $lead->status }}
                                    </a>
                                </td>
                                <td data-title="Ações" class="actions">
                                    <div class="wrapper-action">
                                        <a class="action-edit" href="{{ route('leads.edit', $lead->id) }}"><i class="fa-solid fa-pen"></i></a>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $lead->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="delete{{ $lead->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja deletar? {{ $lead->title }}</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Essa ação tem efeito permanente.
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-outline-danger delete-item" data-item-id="{{ $lead->id }}">Deletar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    @include('adm.includes.datatable', ['tableid' => 'example', 'targets' => json_encode([0, 5])])
    @include('adm.includes.ajax.delete', ['route' => 'leads'])
    @include('adm.includes.ajax.select', ['route' => 'leads', 'column' => 'title'])

@endsection
