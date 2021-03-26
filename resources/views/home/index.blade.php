@extends('layouts.layout')

@section('title', 'Авторезированный сервис по ремонту электродвигателей')

@section('content')
    <h1>{{$post->name}}</h1>
    {!! $post->content !!}

    @widget('Services')

    <span class="change_color">Поддерживая стабильно высокое качество на производимые работы,
                    предоставляем гарантию не менее 12 месяцев.</span>
    <img src="{{ asset('assets/front/img/proizvodstvo.jpg') }}" alt="" class="uk-align-center uk-margin-remove-top">

@endsection

