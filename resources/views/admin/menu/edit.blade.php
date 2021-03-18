@extends('admin.layouts.layout')

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Создание пункта меню</h1>
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
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Редактирование пункта меню</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="post" action="{{ route('menu.update', ['menu' => $menu_item->id]) }}">
                            @csrf
                            @method('PUT')
                            @include('admin.menu._form')
                        </form>
                    </div>
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
            $('#initialized').on('change', function(e){
                e.preventDefault();
                $(this).find(".page_or_link_value input").attr('disabled', 'disabled');
                $(this).find(".page_or_link_value select").attr('disabled', 'disabled');
                $(this).find(".page_or_link_value").removeClass("d-none").addClass("d-none");
                switch($(this).find('select[name=type]').val()) {
                    case 'external_link':
                        $(this).find(".page_or_link_external_link input").removeAttr('disabled');
                        $(this).find(".page_or_link_external_link").removeClass('d-none');
                        break;

                    case 'category_link':
                        $(this).find(".page_or_link_category_link input").removeAttr('disabled');
                        $(this).find(".page_or_link_category_link select").removeAttr('disabled');
                        $(this).find(".page_or_link_category_link").removeClass('d-none');
                        break;

                    default: // page_link
                        $(this).find(".page_or_link_page select").removeAttr('disabled');
                        $(this).find(".page_or_link_page").removeClass('d-none');
                }
            });

            $('.btn-group-yesno').on('change', function (e){
                e.preventDefault()
                const input = $(this).find('input[name="home"]:checked')
                const label = input.closest('label')
                let value = $('input[name="home"]:checked').val()
                console.log(value)
                console.log(input.closest('label').attr('class'))

                $(this).find('label').removeClass('active btn-success btn-danger')
                label.addClass('active ' + label.data('class'))
            });
        });
    </script>
@endsection

