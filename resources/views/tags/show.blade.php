@extends('layouts.layout')

@section('title', $tag->title)

@section('slider')
    <!-- Слайдер -->
    <div class="uk-position-relative uk-visible-toggle uk-light uk-visible@s" uk-slideshow="autoplay: true; autoplay-interval: 3000; animation: fade">
        <ul class="uk-slideshow-items" uk-height-viewport="offset-top: true; offset-bottom: 30">
            <li>
                <img src="{{ asset('assets/front/img/Slideshow/Slide-1.jpg') }}" alt="" uk-cover>
                <h2 class="slide-title animated fadeIn">Ремонт электродвигателей любых типов</h2>
            </li>
            <li>
                <img src="{{ asset('assets/front/img/Slideshow/Slide-2.jpg') }}" alt="" uk-cover>
                <h2 class="slide-title animated fadeIn">Для всех отраслей и промышленности</h2>
            </li>
        </ul>
        <a class="uk-position-center-left uk-position-small uk-hidden-hover" href="#" uk-slidenav-previous uk-slideshow-item="previous"></a>
        <a class="uk-position-center-right uk-position-small uk-hidden-hover" href="#" uk-slidenav-next uk-slideshow-item="next"></a>
    </div>
@endsection

@section('content')
    <h1>{{ $tag->title }}</h1>
    <div class="uk-child-width-1-3@m uk-child-width-1-2@s uk-grid-match" uk-grid uk-height-match="div > .uk-card >div .uk-card-body">
        @foreach($posts as $post)
            <div>
                <div class="uk-card uk-card-block border-wrap">
                    <div>
                        <div class="uk-card-header uk-tile">
                            <div class="uk-grid">
                                <div class="uk-width-auto">
                                    <img src="{{ $post->getImage()}} " alt="Двигатели до 1000 В" class="uk-float-left">
                                </div>
                                <div class="uk-width-expand uk-padding-remove">
                                    <h3 class="uk-card-title uk-float-left">{{ $post->name }}</h3>
                                </div>
                            </div>
                        </div>
                        <div class="uk-card-body">
                            {!! $post->quote !!}
                        </div>
                        <div class="uk-card-footer">
                            <div class="uk-text-center uk-margin-small-bottom">
                                <a class="btn" href="{{ route('home.single', ['slug' => $post->slug]) }}">Подробнее</a>
                            </div>
                            <div class="uk-flex uk-flex-center uk-flex-around uk-text-small uk-text-muted ">
                                <div class="uk-card ">
                                    <a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}" title="">{{ $post->category->slug }}</a>
                                </div>
                                <div class="uk-card ">
                                    {{ $post->getPostDate() }}
                                </div>
                                <div class="uk-card">
                                    <i class="fas fa-eye"></i> {{ $post->view }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
        <div class="col-md-12">
            <nav aria-label="Page navigation">
                {{ $posts->links('vendor.pagination.uikit3') }}
            </nav>
        </div>
    </div>
    <span class="change_color">Поддерживая стабильно высокое качество на производимые работы,
                    предоставляем гарантию не менее 12 месяцев.</span>
    <img src="{{ asset('assets/front/img/proizvodstvo.jpg') }}" alt="" class="uk-align-center uk-margin-remove-top">

@endsection

