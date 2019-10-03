@extends('admin.layouts.layout')

@section('css')
<style>
    .active-top-show {
        background-color: #fff !important;
    }

    #nav-tabContent {
        padding-top: 10px;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">
                    Добавить страницу
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/pages" class="btn btn-danger">Назад</a>
            </div>
        </div>
        <div class="row">
            @if(empty($page))
            <form class="col-lg-12 col-md-12 row" action="/admin/pages" method="POST" enctype="multipart/form-data">
            @else
            <form class="col-lg-12 col-md-12 row" action="/admin/pages/{{ $page->page_id }}" method="POST" enctype="multipart/form-data">
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
                                <nav>
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab"
                                            href="#nav-home" role="tab" aria-controls="nav-home"
                                            aria-selected="true">Русский</a>
                                        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab"
                                            href="#nav-profile" role="tab" aria-controls="nav-profile"
                                            aria-selected="false">Казахский</a>
                                        <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab"
                                            href="#nav-contact" role="tab" aria-controls="nav-contact"
                                            aria-selected="false">Английский</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" class="form-control" name="page_name_ru" value="{{ !empty($page) ? $page->page_name_ru : old('page_name_ru') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea class="summernote" name="page_content_ru">{{ !empty($page) ? $page->page_content_ru : old('page_content_ru') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" class="form-control" name="page_name_kz" value="{{ !empty($page) ? $page->page_name_kz : old('page_name_kz') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea class="summernote" name="page_content_kz">{{ !empty($page) ? $page->page_content_kz : old('page_content_kz') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" class="form-control" name="page_name_en" value="{{ !empty($page) ? $page->page_name_en : old('page_name_en') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea class="summernote" name="page_content_en">{{ !empty($page) ? $page->page_content_en : old('page_content_en') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Отображать</label><br>
                                    <input type="radio" class="form-check-input" name="is_show" value="1"
                                        id="is_show_yes" {{ (!empty($page) && $page->is_show == 1) ? "checked" : "checked" }}>
                                    <label class="form-check-label" for="is_show_yes">
                                        Да
                                    </label>
                                    <input type="radio" class="form-check-input" name="is_show" value="0"
                                        id="is_show_no" {{ (!empty($page) && $page->is_show == 0) ? "checked" : "" }}>
                                    <label class="form-check-label" for="is_show_no">
                                        Нет
                                    </label>
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
@endsection