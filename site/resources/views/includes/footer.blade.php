<footer>
    <div class="content">
        <a href="{{ route('index') }}">
            <img id="logo" src="{{ asset('img/logoOTECShop.webp')}}" alt="" title="Logo"  width="300" height="87">
        </a>
        <div class="wrapper-footer">
            <div class="content-link about">
                <h3>Sobre</h3>
                <p>
                    <a href="{{ route('a-empresa') }}">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed eiusmod tempor incididunt ut labore et dolore magna aliqua. enim ad minim veniam, quis nos trud exerci tation ullamc olab oris nisi ut aliquip ex ea commodo consequat.
                    </a>
                </p>
            </div>
            <div class="content-link pages">
                <a href="{{ getItem('link-local') }}">
                    <h4>Loja física</h4>
                    <p>{{ getItem('name-local') }}</p>
                </a>
            </div>
            <div class="content-link contact">
                <ul>
                    <li>
                        <a href="{{ getItem('link-whats1') }}" target="_blank">
                            <i class="fa-brands fa-whatsapp"></i>
                            {{ getItem('whats1') }} 
                        </a>
                    </li>
                    <li>
                        <a href="{{ getItem('instagram') }}" target="__blank">
                            <i class="fa-brands fa-instagram"></i>
                            {{ getItem('nome-instagram') }}
                        </a>
                    </li>
                    <li>
                        <a href="{{ getItem('email-link') }}">
                            <i class="fa-regular fa-envelope"></i>
                            {{ getItem('email-client') }}
                        </a>
                    </li>
                </ul>  
            </div>
        </div>
    </div>
</footer>
<div class="byEngenho">
    <a href="https://www.engenhodeimagens.com.br/" target="_blank">
        <picture>
            <source srcset="{{ asset('img/desenvolvido-por-engenho-de-imagens.webp')
        }}" type="image/webp">
            <source srcset="{{ asset('img/desenvolvido-por-engenho-de-imagens.png')}}" type="image/png">
            <img src="{{ asset('img/desenvolvido-por-engenho-de-imagens.webp')
        }}" alt="Engenho de imagens" loading="lazy" width="317" height="22">
        </picture>
    </a>
</div>