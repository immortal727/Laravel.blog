<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">
    <link href="{{ asset('assets/front/css/uikit.min.css') }}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/front/css/front.css') }}">

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="{{ asset('assets/front/js/uikit.min.js') }}"></script>
    <script src="{{ asset('assets/front/js/uikit-icons.min.js') }}"></script>
</head>
<body>
<article class="gradient cont">
    <header>
        <div class="uk-grid">
            <div class="uk-width-1-2@s">
                <div class="uk-flex uk-flex-middle uk-text-center uk-height-1-1">
                    <div class="uk-card-body uk-width-expand uk-padding-small">
                        <span class="logo-text-line"><a href="{{ route('home') }}">"Энергоремонт-Сервис"</a></span>
                        <span class="logo-text-line">Ремонт и перемотка электродвигателей,</span>
                        <span class="logo-text-line">генераторов, трансформаторов</span>
                    </div>
                </div>
            </div>
            <div class="uk-width-1-2@s">
                <div class="uk-flex uk-flex-middle uk-text-center uk-height-1-1">
                    <div class="uk-card-body uk-width-expand uk-padding-small">
                        <a class="tel" href="tel:+78123354017">+7 (812) 335-40-17</a>
                        <a class="logo-text-line">Наше расположение на карте</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-background-wrapper">
            <nav id="nav" class="uk-navbar uk-background-muted uk-border-rounded" uk-navbar>
                <div class="uk-navbar-left uk-visible@s">
                    <ul class="uk-navbar-nav">
                        @include('layouts._menu')
                    </ul>
                </div>
                <div class="uk-navbar-left uk-hidden@s">
                    <ul class="uk-navbar-nav">
                        <li>
                            <a href="#" uk-icon="icon: menu" class="uk-icon"></a>
                            <div class="uk-navbar-dropdown uk-border-rounded uk-background-muted">
                                <ul class="uk-nav uk-navbar-dropdown-nav uk-text-right"
                                    uk-scrollspy="target: > li; cls:uk-animation-slide-right; delay: 300; repeat: true">
                                    <li class=""><a href="">Главная</a></li>
                                    <li class=""><a href="">О компании</a></li>
                                    <li class=""><a href="">Продукция</a></li>
                                    <li class=""><a href="/services">Услуги</a></li>
                                    <li class=""><a href="">Наши работы</a></li>
                                    <li class=""><a href="">Контакты</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <div class="uk-navbar-item">
                        <a class="uk-icon-button" uk-icon="icon: search" href="#modal-full" uk-toggle></a>
                        <div id="modal-full" class="uk-modal-full" uk-modal>
                            <div class="uk-modal-dialog">
                                <button class="uk-modal-close" type="button" uk-icon="icon: close"></button>
                                <div class="uk-modal-header">
                                    <div id="search-searchbar">
                                        <div class="ais-search-box">
                                            <input autocapitalize="off" autocomplete="off" autocorrect="off"
                                                   placeholder="Поиск..." role="textbox" spellcheck="false" type="text"
                                                   value="" class="ais-search-box--input">
                                            <span class="ais-search-box--magnifier-wrapper">
                                                <div class="ais-search-box--magnifier">
                                                    <span uk-icon="icon: search"></span>
                                                </div>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="uk-modal-body">

                                </div>
                            </div>
                        </div>
                        <div class="uk-hidden@s">

                        </div>
                    </div>

                </div>
            </nav>
        </div>
    </header>

    <section>
        <article class="uk-article uk-container">
            <div class="uk-grid-small" uk-grid>
                <div class="uk-visible@s uk-width-auto">
                    <div class="widget">
                        <h3>Популярные посты</h3>
                        @foreach($popular_posts as $post)
                            <div>
                                <img src="{{ $post->getImage() }}" class="uk-float-left uk-margin-small-right"/>
                                <small>{!! $post->quote !!}</small>
                                <time class="uk-text-meta">{{ $post->getPostDate() }} | <i class="fa fa-eye"></i> {{ $post->view }}</time>
                            </div>
                        @endforeach
                    </div>
                    <div class="widget">
                        <h3>Категории</h3>
                        <ul class="list-section list">
                        @foreach($cats as $cat)
                                <li>
                                    <div>
                                        <a href="{{ route('categories.single', ['slug' =>  $cat->slug]) }}">
                                            <span>{{ $cat->title }}</span>
                                            <span class="wr-line-dotted"></span>
                                            <span><i class="fa fa-eye"></i> {{ $cat->posts_count }}</span>
                                        </a>
                                    </div>
                                </li>
                        @endforeach
                        </ul>
                        {{--<ul class="list-section list">
                            @foreach($popular_posts as $post)
                                <li>
                                    <div>
                                        <a href="{{ route('home.single', ['slug' =>  $post->slug]) }}">
                                           <img src="{{ $post->getImage() }}" class="img_fluid float-lef" />
                                            <span>{{ $post->title }}</span>
                                            <span class="wr-line-dotted"></span>
                                            <span><i class="fa fa-eye"></i> {{ $post->view }}</span>
                                            <span>{{ $post->getPostDate() }}</span>
                                        </a>
                                    </div>
                                </li>
                            @endforeach--}}

                        {{--<li>
                             <ul class="list-paragraph list">
                                <li>
                                    <div>
                                        <a href="#">
                                            <span>Параграф 1</span>
                                            <span class="wr-line-dotted"></span>
                                            <span>cтр. 257</span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>--}}
                    </div>
                </div>
                <div class="uk-width-expand"> @yield('content')</div>
            </div>
            <!-- Условие Если страница не главная -->
            @if(!Request::is('/'))
                @yield('gallery')
            @endif
        </article>
    </section>
    <footer>
        <div class="uk-container">
            <div class="uk-text-center copyright uk-text-muted">Энергоремонт-Сервис &copy; 2005 - 2020.</div>
        </div>
    </footer>

    </div>
    <div id="go-top">
        <a href="" id="up"><span></span></a>
    </div>
    <script src="{{ asset('assets/front/js/front.js') }}"></script>
    <script>

    </script>
</body>
</html>
