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

<div class="options-collapsed notifications" id="linkNotifications2" style='display: none'>
    @foreach ($leads as $lead)
        <a href="{{ route('leads.edit', $lead->id) }}" class="media-link">
            <div class="media">
                <div class="text">
                    <h4 class="media-titulo">{{ $lead->title }}<i class="fa-regular fa-star"></i></h4>
                    <span class="telefone">{{ $lead->telephone }}</span><br>
                    <span class="time"><i class="fa-regular fa-clock"></i> {{ runningTime($lead['created_at']) }}</span>
                </div>
            </div>
        </a>
        <hr>
    @endforeach

    @if(!$leads)
        <p>Nada encontrado.</p>
    @else
        <div class="total-leads">
            <a href="{{ route('leads.index') }}"><p>Veja todas as leads</p></a>
        </div>
    @endif
</div>

<script>
    document.getElementById('leadscount').innerHTML = {{ count($leads) }};
    document.getElementById('linkleadsNotifications').innerHTML = document.getElementById('linkNotifications2').innerHTML;
</script>
