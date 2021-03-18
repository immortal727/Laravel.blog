@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Статьи</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Blank Page</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Список статей</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Добавить статью</a>
                            @if (count($posts))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Наименование</th>
                                            <th>Категория</th>
                                            <th>Теги</th>
                                            <th>Дата</th>
                                            <th>Actions</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($posts as $post)
                                            <tr>
                                                <td>{{ $post->id }}</td>
                                                <td>{{ $post->name ?? '' }}</td>
                                                <td>{{ $post->category->title ?? '' }}</td>
                                                <td>{{ $post->tags->pluck('title')->join(', ') }}</td>
                                                <td>{{ $post->created_at }}</td>
                                                <td>
                                                    <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-info btn-sm float-left mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>

                                                    <form
                                                        action="{{ route('posts.destroy', ['post' => $post->id]) }}"
                                                        method="post" class="float-left">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger btn-sm mr-1"
                                                                onclick="return confirm('Подтвердите удаление')">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
                                                    </form>

                                                    {{--<button type="submit" class="btn btn-info btn-sm active show_item" name="show_item"
                                                            data-route="{{ route('posts.show', ['post' => $post->id]) }}" data-live="{{ $post->live }}">
                                                        @if($post->live)
                                                            <i class="fas fa-eye"></i>
                                                        @else
                                                            <i class="fas fa-eye-slash"></i>
                                                        @endif
                                                        <div class="message"></div>
                                                    </button>--}}
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Статей пока нет...</p>
                            @endif
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $posts->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $('.show_item').on('click', function(e){
            e.preventDefault();
            let live = $(this).data('live'),
                rout = $(this).data('route');

            if ($(this).hasClass('active')) {
                $(this).removeClass('active').addClass('inactive');
                $(this).find('.fas').removeClass('fa-eye').addClass('fa-eye-slash');
                live = 0;
            }else{
                $(this).find('.fas').removeClass('fa-eye-slash').addClass('fa-eye');
                $(this).removeClass('inactive').addClass('active');
                live = 1;
            }

            $.ajax({
                url: rout + '?show=' + live,
                type: 'GET',
                dataType: 'json',
                data: live,
                cache: false, // отключаем кэш
                contentType: false,
                processData: false,
                beforeSend: function () { // Запрос начат
                    // Обезапасим от лишнего кликанья по инпутам
                    $(this).prop('disabled', true);
                },
                success: function (data) {
                    if (data.status == 'ok') {

                    } else {
                        $('.show_item').find('.message').text('Что-то пошло не так, обратитесь к программисту');
                    }
                },
                complete: function () { // Запрос закончен
                    $(this).prop('disabled', false);
                }
            })
            return false;
        });
    </script>
@endsection
