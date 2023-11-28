@extends('layout.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/jpages.css') }}">
@endsection
@section('content')
    <main>
        <img src="{{ asset('img/banner-main.webp') }}" alt="">
    </main>
    <section class="section-products">
        <div class="content">
            <div class="wrapper-content">
                @include('includes.menu-products')
                <div class="all-content">
                    <div class="content-products" id="links">
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                        <div class="product">
                            <div class="img"></div>
                            <div class="info-product">
                                <h3>Nome</h3>
                                <p>Cod.</p>
                            </div>
                            <button>+</button>
                        </div>
                    </div>
                    <div class="holder"></div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
<script src="http://br1002.teste.website/~cvgcom39/novo/public/js/jquery-3.6.4.min.js"></script>
<script src="http://br1002.teste.website/~cvgcom39/novo/public/js/jPages.min.js"></script>
<script>
    $(document).ready(function() {
            
        $(function() {
            function initJPages() {
                $("div.holder").jPages({
                    containerID: "links",
                    perPage: 9,
                    previous: "",
                    next: ""
                });
            }
            initJPages();
        })
    });
</script>
@endsection