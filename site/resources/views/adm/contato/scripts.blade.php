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

    });
</script>