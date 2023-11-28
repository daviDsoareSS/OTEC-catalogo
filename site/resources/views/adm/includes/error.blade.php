@if($errors->any())
    <div class="message message-delete" style="flex-direction: column;">
        <p><i class="fa-solid fa-check"></i></p>
        @foreach($errors->all() as $error)
            <ul>
                <li>{{ $error }}</li>
            </ul>
        @endforeach
    </div>

    <script>
        const messageContent = document.querySelector('.message');

        function ocultMessageContent(){
            messageContent.style.top = '-50%';
            messageContent.style.opacity = 0;
            
        }
        setTimeout(ocultMessageContent, 3000);
    </script>
@endif