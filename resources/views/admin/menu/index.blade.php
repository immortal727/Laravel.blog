@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Меню</h1>
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
                            <h3 class="card-title">Пункты меню</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <a href="{{ route('menu.create') }}" class="btn btn-primary mb-3">
                                <span><i class="fa fa-plus"></i> Добавить пункт меню</span>
                            </a>
                            @if (count($menu_items))
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-nowrap">
                                        <thead>
                                        <tr>
                                            <th style="width: 30px">#</th>
                                            <th>Наименование</th>
                                            <th>Ссылка</th>
                                            <th>Действия</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @include('admin.menu._list_menu_items')
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p>Пунктов меню пока нет...</p>
                            @endif

                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer clearfix">
                            {{ $menu_items->links('vendor.pagination.bootstrap-4') }}
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
            $('.js-more').on('click', function(e) {
                e.preventDefault(); // не отправить пользователя на url
                let wrapper = $(this).closest('tr'); // Для каждого элемента в наборе,
                // получает первый элемент, который совпадает с селектором
                // при движении вверху по DOM дереву элементов.
                $('.' + $(this).data('target')).fadeToggle('slow');
                wrapper.toggleClass('active');
            });
        })
    </script>
@endsection

