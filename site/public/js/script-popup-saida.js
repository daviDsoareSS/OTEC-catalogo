(function() { //protegendo escopo

    function validationModalSair(){
        let inputCel = document.querySelector('#whatsappModalSair');
        inputCel.addEventListener('keyup', function(){
            let valor = mtel(this.value);
            this.value = valor;
        });
        function mtel(v){
            v = v.replace(/\D/g, "");
            v = v.replace(/^(\d{2})(\d)/g, "($1) $2");
            v = v.replace(/(\d)(\d{4})$/, "$1-$2");
            return v;
        }
    }
    validationModalSair();

    let fechouPopupSaida = false //verifica se o usuario ja fechou o popup para não reabrir

    function closePopup(e, id){
        if(id){
            const popup = document.querySelector(`#${id}`)
            popup.style.display = "none"
        } else{
            btnClose = e.target
            btnClose.parentElement.parentElement.style.display = "none"
        }

        fechouPopupSaida = true
    }

    function openPopup(id){
        if(!fechouPopupSaida && !getCookie('enviouPopupSaida')){ //verifica se o usuario não fechou o popup e não enviou o popup nenhuma vez
            const popup = document.querySelector(`#${id}`)
            popup.style.display = "block"

        }
    }
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for(var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
            c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    function aparecerCookie()
    {
        let cookie = document.querySelector("#popup");
        let btnPop = document.querySelector("#privacy-ok");
        btnPop.addEventListener("click", function(){
            setCookie("privacidade", 1, 1);    
            cookie.style.cssText = "display: none";
        });

        let checkCookie = getCookie("privacidade");

        if(document.cookie.indexOf("privacidade") < 0)
        {
            cookie.style.cssText = "display: block";
            console.log(document.cookie.indexOf("privacidade"))
        }
    }
    aparecerCookie();

    document.querySelector(".icon-close-popup").addEventListener("click", closePopup)
    document.querySelector(".underlay").addEventListener("click", () => {
        closePopup( '', 'modal-exit')
    })

    // window.addEventListener('mousemove', function(e) {
    //     if(e.pageY < 3){
    //         openPopup('modal-exit')
    //     }
    // });

    document.addEventListener('mouseleave', (e) => {
        if(e.clientY < 10){
            openPopup('modal-exit')
        }
    })

    document.querySelector('form#popup-exit').addEventListener('submit', e => {
        setCookie('enviouPopupSaida', 'true', 10000)
    })

}
)()