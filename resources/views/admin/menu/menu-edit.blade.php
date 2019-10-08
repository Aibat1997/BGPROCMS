@extends('admin.layouts.layout')

@section('css')
<style>
    .hide {
        display: none;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">
                    Добавить меню/сабменю
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/menu" class="btn btn-danger">Назад</a>
            </div>
        </div>
        <div class="row">
            @if(empty($menu))
            <form class="col-lg-12 col-md-12 row" action="/admin/menu" method="POST">
            @else
            <form class="col-lg-12 col-md-12 row" action="/admin/menu/{{ $menu->menu_id }}" method="POST">
                @method('PUT') 
            @endif    
                @csrf
                <div class="col-lg-8 col-md-12">
                    <div class="card">
                        <div class="card-block">
                            @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                            <div class="box-body">
                                <div class="form-group">
                                    <label>Название(ru)</label>
                                    <input type="text" class="form-control" name="menu_name_ru" value="{{ !empty($menu) ? $menu->menu_name_ru : "" }}" />
                                </div>
                                <div class="form-group">
                                    <label>Название(kz)</label>
                                    <input type="text" class="form-control" name="menu_name_kz" value="{{ !empty($menu) ? $menu->menu_name_kz : "" }}" />
                                </div>
                                <div class="form-group">
                                    <label>Название(en)</label>
                                    <input type="text" class="form-control" name="menu_name_en" value="{{ !empty($menu) ? $menu->menu_name_en : "" }}" />
                                </div>
                                <div class="form-group">
                                    <label>Ссылка</label>
                                    <input type="text" class="form-control" name="menu_url" value="{{ !empty($menu) ? $menu->menu_url : "" }}" />
                                </div>
                                <div class="form-group">
                                    <label>Отображать</label><br>
                                    <input type="radio" class="form-check-input" name="is_show" value="1"
                                        id="is_show_yes" {{ (!empty($menu) && $menu->is_show == 1) ? "checked" : "checked" }}>
                                    <label class="form-check-label" for="is_show_yes">
                                        Да
                                    </label>
                                    <input type="radio" class="form-check-input" name="is_show" value="0"
                                        id="is_show_no" {{ (!empty($menu) && $menu->is_show == 0) ? "checked" : "" }}>
                                    <label class="form-check-label" for="is_show_no">
                                        Нет
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Отображать в меню</label><br>
                                    <input type="radio" class="form-check-input" name="is_show_main" value="1"
                                        id="is_show_main_yes" {{ (!empty($menu) && $menu->is_show_main == 1) ? "checked" : "checked" }}>
                                    <label class="form-check-label" for="is_show_main_yes">
                                        Да
                                    </label>
                                    <input type="radio" class="form-check-input" name="is_show_main" value="0"
                                        id="is_show_main_no" {{ (!empty($menu) && $menu->is_show_main == 0) ? "checked" : "" }}>
                                    <label class="form-check-label" for="is_show_main_no">
                                        Нет
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Сортировка</label>
                                    <input type="number" class="form-control" name="sort_num" value="{{ !empty($menu) ? $menu->sort_num : old('sort_num') }}" />
                                </div>
                                <div class="form-group">
                                    <label>Подменю</label><br>
                                    <input type="radio" class="form-check-input" name="is_sub" value="1"
                                        id="is_sub_yes" {{ (!empty($menu) && $menu->is_sub == 1) ? "checked" : "" }}>
                                    <label class="form-check-label" for="is_sub_yes">
                                        Да
                                    </label>
                                    <input type="radio" class="form-check-input" name="is_sub" value="0" id="is_sub_no" {{ (!empty($menu) && $menu->is_sub == 0) ? "checked" : "" }}>
                                    <label class="form-check-label" for="is_sub_no">
                                        Нет
                                    </label>
                                </div>
                                <div class="form-group {{ (!empty($menu)) ? "" : "hide" }}">
                                    <label>К меню</label>
                                    <select name="main_menu_id" class="form-control">
                                        @include('admin.layouts.menu')
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>К странице</label>
                                    <select name="menu_page_id" class="form-control">
                                        @include('admin.layouts.page')
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 text-right">
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary">Сохранить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        $('input:radio[name="is_sub"]').change(function () {
            if ($(this).val() == 1) {
                console.log("asd");
                $('.hide').show();
            } else {
                $('.hide').hide();
            }
        });
    });
</script>
@endsection