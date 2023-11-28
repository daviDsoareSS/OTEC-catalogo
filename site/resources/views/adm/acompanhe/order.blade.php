@extends('adm.template.layout')
@section('title', 'Acompanhe - Order')
@section('description', '')

@section('head')
    <style>
        .message {
            position: fixed;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border-radius: 4px;
            opacity: 0;
            transition: top 0.3s ease, opacity 0.3s ease;
        }

        .message.show {
            top: 20px;
            opacity: 1;
        }
    </style>
@endsection

@section('content')

    <div class="message message-success" >
        <p><i class="fa-solid fa-check"></i> Ordenagem com sucesso!</p>
    </div>
    
    <div class="content">
        <p class="description-content">Arraste a publicação e ordene da forma que deseja</p>
        <div class="table-acompanhe-order" id="table">
            <table class="table-acompanhe">
                <thead>
                    <tr>
                        <th>Postagem</th>
                        <th>Autor</th>
                        <th>Data e hora</th>
                        <th>Status</th>
                        <th>Ordem</th>
                    </tr>
                </thead>
                <tbody id="table-body">
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
                </tbody>
            </table>
        </div>
    </div>

@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.13.0/Sortable.min.js"></script>
    <script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            var sortableList = document.getElementById('table-body');
            var sortable = new Sortable(sortableList, {
                draggable: 'tr',
                onSort: function (event) {
                    var item = event.item;
                    var newPosition = Array.from(item.parentNode.children).indexOf(item) + 1;
                    var orderData = Array.from(sortableList.children).map(function(child) {
                        return child.getAttribute('data-item-id');
                    });
                    
                    // Send an AJAX request to update the item's position in the database
                    $.ajax({
                        url: '{{ route("acompanhe.order-update") }}',
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            order: orderData
                        },
                        success: function(res) {
                            $('#table-body').html(res);

                            // Show the success message
                            $('.message').addClass('show');

                            // Hide the success message after 3 seconds
                            setTimeout(function() {
                                $('.message').removeClass('show');
                            }, 3000);

                        },
                    });
                }
            });
        });

    </script>
@endsection