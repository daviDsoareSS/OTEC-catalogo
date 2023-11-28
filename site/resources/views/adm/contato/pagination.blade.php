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
        @foreach ($contatos as $contato)
            <tr>
                <td data-title="Selecione" class="checkbox-items">
                    <input type="checkbox" value="{{ $contato->id }}">
                </td>
                <td class="title"><a href="{{ route('contato.edit', $contato->id) }}">{{ $contato->title }}</a></td>
                <td data-title="Telefone"><a href="{{ route('contato.edit', $contato->id) }}">{{ $contato->telephone }}</a></td>
                <td data-title="Data"><a href="{{ route('contato.edit', $contato->id) }}">{{ $contato->date }} - {{ $contato->time }}</a></td>
                <td data-title="Status" class="{{ $contato->status == 'lido' ? 'lido' : 'nao-lido' }}"><a href="{{ route('contato.edit', $contato->id) }}">{{ $contato->status }}</a></td>
                <td data-title="Ações" class="actions">
                    <div class="wrapper-action">
                        <a class="action-edit" href="{{ route('contato.edit', $contato->id) }}"><i class="fa-solid fa-pen"></i></a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete{{ $contato->id }}">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </td>
            </tr>
            <!-- Modal -->
            <div class="modal fade" id="delete{{ $contato->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Deseja deletar? {{ $contato->title }}</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Essa ação tem efeito permanente.
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-outline-danger delete-item" data-item-id="{{ $contato->id }}">Deletar</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </tbody>
</table>
<div class="options-collapsed notifications" id="linkContatoNotifications2" style='display: none'>
    @foreach ($contatos as $contato)
        <a href="{{ route('contato.edit', $contato->id) }}" class="media-link">
            <div class="media">
                <div class="text">
                    <h4 class="media-titulo">{{ $contato->title }}<i class="fa-regular fa-star"></i></h4>
                    <span class="telefone">{{ $contato->telephone }}</span><br>
                    <span class="time"><i class="fa-regular fa-clock"></i> {{ runningTime($contato['created_at']) }}</span>
                </div>
            </div>
        </a>
        <hr>
    @endforeach

    @if(!$contatos)
        <p>Nada encontrado.</p>
    @else
        <div class="total-news">
            <a href="{{ route('contato.index') }}"><p>Veja todos os contatos</p></a>
        </div>
    @endif
</div>

<script>
    document.getElementById('contatocount').innerHTML = {{ count($contatos) }};
    document.getElementById('linkContatoNotifications').innerHTML = document.getElementById('linkContatoNotifications2').innerHTML;
</script>
