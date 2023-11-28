<script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('js/jquery.mask.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#tel').mask('(00) 00000-0000');
    
    })
    var maxLength = 255;

    $('#textarea').keyup(function() {
        var textlen = maxLength - $(this).val().length;
        $('#rchars').text(textlen);
        if(textlen <= 0) {
            $('#textarea').css()
        }
    });

    const messageContent = document.querySelector('.message');

    function ocultMessageContent(){
        messageContent.style.top = '-50%';
        messageContent.style.opacity = 0;
        
    }
    setTimeout(ocultMessageContent, 2000);

</script>