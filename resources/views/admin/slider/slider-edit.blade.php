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
                    Добавить слайд
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/slider" class="btn btn-danger">Назад</a>
            </div>
        </div>
        <div class="row">
            @if(empty($slider))
            <form class="col-lg-12 col-md-12 row" action="/admin/slider" method="POST" enctype="multipart/form-data">
            @else
            <form class="col-lg-12 col-md-12 row" action="/admin/slider/{{ $slider->slider_id }}" method="POST" enctype="multipart/form-data">
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
                                            <label>Текст</label>
                                            <textarea name="slider_text_ru" class="form-control">{{ !empty($slider) ? $slider->slider_text_ru : old('slider_text_ru') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                        <div class="form-group">
                                            <label>Текст</label>
                                            <textarea name="slider_text_kz" class="form-control">{{ !empty($slider) ? $slider->slider_text_kz : old('slider_text_kz') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                        <div class="form-group">
                                            <label>Текст</label>
                                            <textarea name="slider_text_en" class="form-control">{{ !empty($slider) ? $slider->slider_text_en : old('slider_text_en') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Ссылка</label>
                                    <input type="text" class="form-control" name="slider_url" value="{{ !empty($slider) ? $slider->slider_url : old('slider_url') }}" />
                                </div>
                                <div class="form-group">
                                    <label>Отображать</label><br>
                                    <input type="radio" class="form-check-input" name="is_show" value="1"
                                        id="is_show_yes" {{ (!empty($slider) && $slider->is_show == 1) ? "checked" : "checked" }}>
                                    <label class="form-check-label" for="is_show_yes">
                                        Да
                                    </label>
                                    <input type="radio" class="form-check-input" name="is_show" value="0"
                                        id="is_show_no" {{ (!empty($slider) && $slider->is_show == 0) ? "checked" : "" }}>
                                    <label class="form-check-label" for="is_show_no">
                                        Нет
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Позиция</label>
                                    <select class="form-control" name="slider_position">
                                        @include('admin.layouts.select-position')
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Сортировка</label>
                                    <input type="number" class="form-control" name="sort_num" value="{{ !empty($slider) ? $slider->sort_num : old('sort_num') }}" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="box box-primary" style="padding: 30px; text-align: center">
                                <div style="padding: 20px; border: 1px solid #c2e2f0">
                                    <img class="image-src" id="blah" src="{{ (!empty($slider)) ? $slider->slider_image : "/img/default-image.jpg" }}" style="width: 100%; " />
                                </div>
                                <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                                <label class="btn btn-primary" for="imgInp">
                                    <input id="imgInp" type="file" name="slider_image" class="d-none">
                                    <i class="fa fa-plus"></i>
                                </label>
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