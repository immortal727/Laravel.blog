@extends('layouts.layout')

@section('title', 'Авторезированный сервис по ремонту электродвигателей')
@section('menu')
   {{-- @widget('menu')--}}
@endsection
@section('content')
    <div class="uk-child-width-1-3@m uk-child-width-1-2@s uk-grid-match" uk-grid uk-height-match="div > .uk-card >div .uk-card-body">
        @foreach($posts as $post)
            @if($post->category_id!=0)
                <div>
                    <div class="uk-card uk-card-block border-wrap">
                        <div>
                            <div class="uk-card-header uk-tile">
                                <div class="uk-grid">
                                    <div class="uk-width-auto">
                                        <img src="{{ $post->getImage()}} " alt="{{ $post->title }}" class="uk-float-left">
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
                                        <a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}" title="">{{ $post->category->title }}</a>
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
            @endif
        @endforeach
    </div>
    @if(count($posts)>6)
        <div class="row">
            <div class="col-md-12">
                <nav aria-label="Page navigation">
                    {{ $posts->links('vendor.pagination.uikit3') }}
                </nav>
            </div>
        </div>
    @endif

    <span class="change_color">Поддерживая стабильно высокое качество на производимые работы,
                    предоставляем гарантию не менее 12 месяцев.</span>
    <img src="{{ asset('assets/front/img/proizvodstvo.jpg') }}" alt="" class="uk-align-center uk-margin-remove-top">

@endsection

