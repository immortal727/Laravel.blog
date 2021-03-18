@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Категории</h1>
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
                            <h3 class="card-title">Список альбомов галлереи</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('create_album_form') }}" class="btn btn-primary mb-3">Добавить
                                альбом</a>
                            @if (count($albums))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Фото</th>
                                            <th>Наименование</th>
                                            <th>Описание</th>
                                            <th>Кол-во</th>
                                            <th>Дата создания</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @include('admin.albums.listAlbums')
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Категорий пока нет...</p>
                            @endif

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $albums->links('vendor.pagination.bootstrap-4') }}
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
        $(document).ready(function() {
            $('.js-more').on('click', function(e) {
                e.preventDefault(); // не отправить пользователя на url
                let wrapper = $(this).closest('tr'); // Для каждого элемента в наборе,
                // получает первый элемент, который совпадает с селектором
                // при движении вверху по DOM дереву элементов.
                console.log('xdd');
                $('.' + $(this).data('target')).fadeToggle('slow');
                wrapper.toggleClass('active');
            });
        })
    </script>
@endsection

