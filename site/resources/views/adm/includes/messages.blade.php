@if(session()->has('success'))
    <div class="message message-success" id="message-success">
        <p><i class="fa-solid fa-check"></i> {{ session()->get('success') }}</p>
    </div>
@endif
@if(session()->has('delete'))
    <div class="message message-delete">
        <p><i class="fa-solid fa-check"></i> {{ session()->get('delete') }}<p>
    </div>
@else
    <div class="message message-delete" style="display: none;">
        <i class="fa-solid fa-check"></i>
        <p id="message"> Itens deletados com sucesso!<p>
    </div>
@endif

<script>
    function ocultMessageContent(message){
        message.style.opacity = 0;
    }
    setTimeout(function() {
        var successMessage = document.getElementById('message-success');
        ocultMessageContent(successMessage);
    }, 3000);
</script>