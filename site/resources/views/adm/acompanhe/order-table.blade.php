@foreach ($acompanhelist as $acompanhe)
    <tr data-item-id="{{ $acompanhe->id }}">
        <td class="title">
            <p>{{ $acompanhe->title }}
            <br>
            <span>{{ $acompanhe->subtitle }}</span></p>
        </td>
        <td class="author">{{ $acompanhe->author }}</td>
        <td class="date">{{ $acompanhe->date }} - {{ $acompanhe->time }}</td>
        <td class="{{ $acompanhe->status == 'Publicado' ? 'status-publicado' : 'status-pendente' }}">{{ $acompanhe->status }}</td>
        <td class="ordem">{{ $acompanhe->order }}°</td>
    </tr>
@endforeach

