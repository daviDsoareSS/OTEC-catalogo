@extends('adm.template.layout')
@section('title', 'Metatags')

@section('head')
    <style>
        #table {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }
        .items {
            min-width: 30%;
            max-width: 30%;
            flex-basis: max-content;
            text-align: left;
        }
        .collapseitem {
            color: white;
            background: rgb(56, 56, 56);
            border: none;
            width: 100%;
            padding: 8px 0px;
        }
        .card-bottom {
            display: flex;
            flex-direction: row;
            gap: 14px;
            align-items: center;
            justify-content: end;
            background-color: rgb(196, 196, 196);
        }
        .metatag.blue {
            color: blue;
        }
        .metatag.red {
            color: red;
        }
        .metatag.code {
            color: gray;
        }
        @media(max-width: 960px){
            #table {
                flex-direction: column;
            }
            .items {
                max-width: 100%;
            }
        }
    </style>
@endsection

@section('content')
<div class="content">
    @if(session()->has('success'))
        <div class="message message-success">
            <p><i class="fa-solid fa-check"></i>{{ session()->get('success') }}<p>
        </div>
    @endif

    @if(session()->has('delete'))
        <div class="message message-delete">
            <p><i class="fa-solid fa-check"></i>{{ session()->get('delete') }}<p>
        </div>
    @endif

    <div class="info">
        <div class="row">
            <div class="col">
                <button type="button" class="btn btn-success btn-create" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span>Cadastrar  </span><i class="fa-solid fa-plus"></i>
                </button>

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Cadastrar uma nova página:</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                            </div>
                            <div class="modal-body">
                                <div class="mb-3">
                                    <label for="pagina" class="form-label">Nome da página: </label>
                                    {{-- <input class="form-control" type="text" name="pagina" id="pagina"> --}}
                                    <select class="form-control" name="pagina" id="pagina">
                                        @foreach ($routeslist as $route)
                                            <option value="{{ $route }}">{{ $route }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="description" class="form-label">Descrição da página: </label>
                                    <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="keywords" class="form-label">Palavras chaves da página: </label>
                                    <input type="text" class="form-control" id="keywords" name="keywords" placeholder="keywords" oninput="addCommaAfterSpace(event)">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                <button type="button" id="submit" class="btn btn-outline-success">Cadastrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="table">
            @foreach($metatags as $metatag)
            <div class="items">
                <button class="collapseitem" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $metatag->id }}" aria-expanded="false" aria-controls="collapseExample">
                    {{ $metatag->pagina }}
                </button>
                <div class="collapse" id="collapse{{ $metatag->id }}">
                    <div class="card card-body">
                        <span class="text-primary" style="font-weight: bold">Descrição dessa página: </span>{{ $metatag->descricao }}
                        <span class="text-danger" style="font-weight: bold">Palavras-chaves dessa página: </span>{{ $metatag->keywords }}
                    </div>
                    <div class="card card-body card-bottom" style="background-color: rgb(196, 196, 196);">
                        <a href="#" class="action-edit" data-bs-toggle="modal" data-bs-target="#edit{{ $metatag->id }}"><i class="fa-solid fa-pen"></i></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $metatag->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- EDITAR -->
            <div class="modal fade" id="edit{{ $metatag->id }}" tabindex="-1" aria-labelledby="Editar" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="Editar">Editar informações da página {{ $metatag->pagina }}: </h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="pagina" class="form-label">Nome da página: </label>
                                <input class="form-control" type="text" name="pagina" id="pagina{{ $metatag->id }}" value="{{ $metatag->pagina }}" disabled>
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descrição da página: </label>
                                <textarea class="form-control" name="description" id="description{{ $metatag->id }}" rows="3">{{ $metatag->descricao }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="keywords" class="form-label">Palavras chaves da página: </label>
                                <input type="text" class="form-control" id="keywords{{ $metatag->id }}" name="keywords" placeholder="keywords" oninput="addCommaAfterSpace(event)" value="{{ $metatag->keywords }}">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="button" id="{{ $metatag->id }}" onclick="editar(this)" class="btn btn-outline-success">Editar</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DELETAR -->
            <div class="modal fade" id="delete{{ $metatag->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja deletar? {{ $metatag->pagina }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                        </div>
                        <div class="modal-body">
                            Essa ação tem efeito permanente.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-outline-danger delete-item" data-item-id="{{ $metatag->id }}">Deletar</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
@section('scripts')
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    @include('adm.includes.ajax.delete', ['route' => 'metatags'])
    <script>
        function addCommaAfterSpace(event) {
            var inputElement = event.target;
            var input = inputElement.value;
            input = input.replace(/,/g, '');

            // Add commas after spaces
            var output = input.replace(/ /g, ', ');
            inputElement.value = output;
        }

        $(document).ready(function() {
            $('#submit').on('click', function() {
                let pagina = $('#pagina').val();
                let descricao = $('#description').val();
                let keywords = $('#keywords').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('metatags.store') }}",
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    data: {
                        pagina: pagina,
                        descricao: descricao,
                        keywords: keywords,
                    },
                    success: function(res) {
                        $('#table').html(res);
                        $('.modal').modal('hide');
                        $('.modal-backdrop').hide();
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            });
        });

        function editar(button) {
            let id = button.id
            let pagina = $('#pagina'+id).val();
            let descricao = $('#description'+id).val();
            let keywords = $('#keywords'+id).val();

            $.ajax({
                type: 'PUT',
                url: "{{ route('metatags.update', "+ id +") }}",
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                data: {
                    id: id,
                    pagina: pagina,
                    descricao: descricao,
                    keywords: keywords,
                },
                success: function(res) {
                    $('#table').html(res);
                    $('.modal').modal('hide');
                    $('.modal-backdrop').hide();
                },
                error: function(error) {
                    console.log(error)
                }
            });
        }
    </script>
@endsection
