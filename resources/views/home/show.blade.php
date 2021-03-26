@extends('layouts.columnLeft')

@section('title', $post->title)

@section('content')
    <ul class="uk-breadcrumb" style="display: inline-flex">
        <li><a href="{{ route('home') }}">Главная</a></li>
        {{--<li><a href="{{ route('categories.single', ['slug' => $post->category->slug]) }}">{{ $post->category->title }}</a></li>--}}
        <li>{{ $post->name }}</li>
    </ul>
    <div class="uk-flex uk-article-meta">
        <div class="uk-padding-small">
            {{ $post->getPostDate() }}
        </div>
        <div class="uk-padding-small">
            <i class="fa fa-eye"> {{ $post->view }}</i>
        </div>
    </div>

    <h1 class="uk-article-title uk-margin-remove">{{ $post->name }}</h1>
    {!! htmlspecialchars_decode($post->content) !!}

    @if($post->slug == 'kontakty')
        @include('home.contact_form')
    @endif

    @if($post->tags->count())
        <div class="tag-cloud-single">
            <ul class="cloud" role="navigation" aria-label="Webdev tag cloud">
                @foreach($post->tags as $tag)
                    <li class="uk-text-small"><a href="{{ route('tags.single', ['slug' => $tag->slug]) }}" data-weight="@php echo rand(1, 9) @endphp"  title="">{{ $tag->title }}</a></li>
                @endforeach
            </ul>
        </div><!-- end meta -->
    @endif
@endsection

@section('gallery')
    Галлеря
@endsection
