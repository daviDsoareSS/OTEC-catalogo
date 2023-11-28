@extends('layout.layout')
@section('head')
    <link rel="stylesheet" href="{{ asset('css/catalogo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/produtos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick-theme.css') }}">
@endsection
@section('content')
    <section class="product">
        <div class="content">
            <div class="image-product">
                <div class="slider slider-for img">
                    <div>
                        <img src="https://images.unsplash.com/photo-1656336659715-dad97d10af6a?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzYxNDI&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1657143376804-2c8ef7bfa72d?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzYxNDI&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1656014816561-8fdaa3c6b11d?crop=100x100entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzY2ODM&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1657659558323-08b7854ed766?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzY3MjA&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1657182688568-fdddf99fcd09?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzY3MjA&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                </div>
                <div class="slider slider-nav">
                    <div>
                        <img src="https://images.unsplash.com/photo-1656336659715-dad97d10af6a?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzYxNDI&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1657143376804-2c8ef7bfa72d?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzYxNDI&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1656014816561-8fdaa3c6b11d?crop=100x100entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzY2ODM&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1657659558323-08b7854ed766?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzY3MjA&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                    <div>
                        <img src="https://images.unsplash.com/photo-1657182688568-fdddf99fcd09?crop=entropy&cs=tinysrgb&fm=jpg&ixid=MnwzMjM4NDZ8MHwxfHJhbmRvbXx8fHx8fHx8fDE2NTg1NzY3MjA&ixlib=rb-1.2.1&q=80" alt="" srcset="">
                    </div>
                </div>
            </div>
            <div class="info-product">
                <h3>Nome do produto</h3>
                <h4>Cod.</h4>
                <div class="text">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea cupiditate dignissimos rerum optio illo unde quod vero odit aut, repudiandae excepturi cumque sit enim praesentium vel, iusto, tenetur atque officiis? Lorem ipsum, dolor sit amet consectetur adipisicing elit. Suscipit nisi laudantium, fuga est, placeat iusto in explicabo enim perferendis eligendi error unde eius maxime amet! Totam nobis adipisci reiciendis voluptas!</p>

                    <div class="price">
                        <h3>R$ XX,XX</h3>
                    </div>
                </div>
                <div class="footer">
                    <a href="">Quero comprar</a>
                </div>
                <span>
                    <a href="{{ route('index') }}">Voltar</a>
                </span>
            </div>
        </div>

    </section>
@endsection

@section('scripts')
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="{{ asset('js/slick.min.js') }}"></script>
<script>
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 3,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: false,
        focusOnSelect: true
    });
    $('.slider-single').on('afterChange', function(event, slick, currentSlide) {
 	$('.slider-nav').slick('slickGoTo', currentSlide);
 	var currrentNavSlideElem = '.slider-nav .slick-slide[data-slick-index="' + currentSlide + '"]';
 	$('.slider-nav .slick-slide.is-active').removeClass('is-active');
 	$(currrentNavSlideElem).addClass('is-active');
 });

 $('.slider-nav').on('click', '.slick-slide', function(event) {
 	event.preventDefault();
 	var goToSingleSlide = $(this).data('slick-index');

 	$('.slider-single').slick('slickGoTo', goToSingleSlide);
 });
</script>
@endsection