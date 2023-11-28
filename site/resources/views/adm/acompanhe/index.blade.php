@extends('adm.template.layout')
@section('title', 'Acompanhe')
@section('content')
    @include('adm.includes.messages')

    <div class="content">
        <div class="info">
            <div class="row">
                <div class="col" style="display: flex; align-items: center;">
                    <a href="{{ route('acompanhe.create') }}" class="btn btn-success btn-create"><span>Cadastrar  </span><i class="fa-solid fa-plus"></i></a>

                    <a href="{{ route('acompanhe.order') }}" class="btn btn-move"><span>Ordenar  </span><i class="fa-solid fa-arrows-up-down-left-right"></i></a>

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
                <table class="table-acompanhe" id="example">
                    <thead>
                        <tr style="border-bottom: 0px">
                            <th>Selecione</th>
                            <th data-sortas="case-insensitive">Postagem</th>
                            <th>Autor</th>
                            <th data-sortas="datetime">Data e hora</th>
                            <th>Status</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                    @foreach ($acompanhelist as $acompanhe)
                        <tr>
                            <td data-title="Selecione" class="checkbox-items">
                                <input type="checkbox" value="{{ $acompanhe->id }}">
                            </td>
                            <td class="title">
                                <a href="{{ route('acompanhe.edit', $acompanhe->id) }}">
                                    {{ $acompanhe->title }}
                                </a>
                            </td>
                            <td data-title="Autor" class="author">
                                <a href="{{ route('acompanhe.edit', $acompanhe->id) }}">
                                    {{ $acompanhe->author }}
                                </a>
                            </td>
                            <td data-title="Data" class="date" data-sortas="datetime">
                                <a href="{{ route('acompanhe.edit', $acompanhe->id) }}">
                                    {{ $acompanhe->datePost }}
                                </a>
                            </td>

                            @if($acompanhe->order == 1 && $acompanhe->status == 'Publicado')
                                <td data-title="Status" class="status-principal">
                                    <a href="{{ route('acompanhe.edit', $acompanhe->id) }}">
                                        Conteúdo príncipal
                                    </a>
                                </td>
                            @else
                                <td data-title="Status" class="{{ $acompanhe->status == 'Publicado' ? 'status-publicado' : 'status-pendente' }}">
                                    <a href="{{ route('acompanhe.edit', $acompanhe->id) }}">
                                        {{ $acompanhe->status }}
                                    </a>
                                </td>
                            @endif

                            <td data-title="Ações">
                                <div class="wrapper-action">
                                    <a class="action-edit" href="{{ route('acompanhe.edit', $acompanhe->id) }}"><i class="fa-solid fa-pen"></i></a>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $acompanhe->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="delete{{ $acompanhe->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja deletar? {{ $acompanhe->title }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Essa ação tem efeito permanente.
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-outline-danger delete-item" data-item-id="{{ $acompanhe->id }}">Deletar</button>
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
    @include('adm.includes.ajax.delete', ['route' => 'acompanhe'])
    @include('adm.includes.ajax.select', ['route' => 'acompanhe', 'column' => 'title'])
@endsection
