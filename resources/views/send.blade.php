@extends('layouts.layout')

@section('title', 'Отправка сообщения на Email')

@section('content')
    <div class="container">
        <div class="alert alert-success">
            <form method="post" action="{{route('send')}}">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Ваше имя</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name ="email" rows="3">
                </div>

                <div class="mb-3">
                    <label for="text" class="form-label">Ваше сообщение</label>
                    <textarea class="form-control" id="text" name="text" rows="5"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection

