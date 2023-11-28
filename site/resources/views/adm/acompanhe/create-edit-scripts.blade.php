<script src="{{ asset('js/jquery-3.6.4.min.js') }}"></script>
<script src="{{ asset('js/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('ckeditor', {
        filebrowserUploadUrl: "{{ route('acompanhe.ckeditor-upload', ['_token' => csrf_token()]) }}",
        filebrowserUploadMethod: 'form',
        extraPlugins: 'youtube'
    });
</script>

<script type="text/javascript">
    const previewImage = document.querySelector('#uploadPreviewImage')
    const InputImage = document.querySelector('#inputImage')
    const IframeVideo = document.querySelector('#uploadPreviewVideo')
    const divImage = document.querySelector('.col-image')
    const divVideo = document.querySelector('.col-video')

    // Obtém uma referência para o elemento checkbox
    const checkboxPublicarAgora = document.querySelector('.publicar-agora');
    const checkboxAgendar = document.querySelector('.agendar');
    const formAgendamento = document.querySelector('.form-agendamento');

    const inputsAgendamento = document.querySelectorAll('.form-agendamento input');

    function checkAgendamento() {
        if (checkboxPublicarAgora.checked) {
            // Ação a ser executada quando o checkbox é selecionado
            formAgendamento.classList.add('disable')

                inputsAgendamento.forEach(function(inputs){
                inputs.value = '';
            })
        }else{
            formAgendamento.classList.remove('disable')
        }
    }

    window.addEventListener('change',function(){
        checkAgendamento()
    })
    $(document).ready(() => {
        checkAgendamento()
    });

    function changeOptions(selectElement) {
        let opcaoSelecionada = selectElement.value;

        if (opcaoSelecionada === 'video') {
            MostrarIframe();
        } else if (opcaoSelecionada === 'texto') {
            MostrarImagem();
        }
    }
    function MostrarIframe() {

        InputImage.value = '';
        // previewImage.src = '';
        divImage.style.display = 'none';
        divVideo.style.display = 'block';
        previewImage.style.display = 'none';
        IframeVideo.style.display = 'block';
        IframeVideo.style.backgroundImage = 'url("{{ asset("img/photonotfound.png") }}")';
        IframeVideo.style.backgroundSize = 'contain';
        IframeVideo.style.backgroundRepeat = 'no-repeat';
        IframeVideo.classList.add('active')
    }

    function MostrarImagem() {

        previewImage.style.display = 'block';
        divImage.style.display = 'block';
        divVideo.style.display = 'none';
        IframeVideo.style.display = 'none';
        IframeVideo.classList.remove('active')
    }

    function CountCaracters(lengthObj,type){
        if(type == 'video') {
            if(lengthObj >= 11)
            {
                var prevImage = $('#uploadVideo').val();
                var x = $("#uploadPreviewVideo").attr("src", "https://www.youtube.com/embed/"+prevImage);
            }
        }
    }

    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("inputImage").files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("uploadPreviewImage").src = oFREvent.target.result;
            $('#uploadPreviewImage').css('opacity', 1);
            $('#uploadPreviewImage').css('display', 'initial');
        };
    };
</script>

<script>
    $(document).ready(function() {
        let titleMaxLength = 100;
        $('#title').keyup(function() {
            let textlen = titleMaxLength - $(this).val().length;
            $('#titlechars').text(textlen);
        });

        let subTitleMaxLength = 255;
        $('#subtitle').keyup(function() {
            let textlen = subTitleMaxLength - $(this).val().length;
            $('#subtitlechars').text(textlen);
        });
    });
</script>
