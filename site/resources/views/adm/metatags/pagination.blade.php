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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="fechar"></button>
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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="fechar"></button>
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
