@extends('layouts.layout')

@section('title', 'Главная')


@if (Route::has('login'))
@auth

@section('slider')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner">

        <div class="navaslider">
            <div class="wrap-navaslider-content clearfix">
                <div id="js-main-slider" class="main-slider owl-carousel owl-loaded owl-drag">
                    <div class="owl-stage-outer">
                        <div class="owl-stage" style="transform: translate3d(-14840px, 0px, 0px); transition: all 0.25s ease 0s; width: 50085px;">
                            @foreach($news as $new)
                            <div class="owl-item cloned" style="width: 1855px;">
                                <div class="wrap-main-slide">

                                    <img src="{{ $new->getImage() }}" alt="">
                                    <div class="slide-content-outer">
                                        <div class="container">
                                            <div class="js-slide-content slide-content-inner">
                                                <h3 class="slide-content-inner-title">{{$new->title_news}}</h3>
                                                <a class="slide-content-inner-btn" href="{{ route('news') }}"><span>Подробнее</span></a>
                                                <br>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@endauth
@endif

@section('content')

<h2>Последние новости общежития</h2>
<div class="row">
    <div class="col-md-12">
        <div class="row-news">
            @foreach($news as $new)
            <div class="col-md-6 col-item-news col-first-news">
                <div class="wrap-item-news " style="display: flex; justify-content: center; align-items: center; height: 400px;">
                    <a href="{{ route('news') }}">
                        <img src="{{ $new->getImage() }}" style="width: 100%;" alt="">
                        <span class="wrap-news-content">
                            <span class="news-content">
                                <time>{{$new->getPostDate() }}</time>
                                <h3>{{$new->title_news}}</h3>
                            </span>
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection