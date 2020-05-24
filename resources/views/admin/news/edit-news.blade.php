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
                    Добавить новость
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/news" class="btn btn-danger">Назад</a>
            </div>
        </div>
        <div class="row">
            @if(empty($news))
            <form class="col-lg-12 col-md-12 row" action="/admin/news" method="POST" enctype="multipart/form-data">
            @else
            <form class="col-lg-12 col-md-12 row" action="/admin/news/{{ $news->news_id }}" method="POST" enctype="multipart/form-data">
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
                                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" class="form-control" name="news_name_ru" value="{{ !empty($news) ? $news->news_name_ru : old('news_name_ru') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea id="editor" name="news_desc_ru">{{ !empty($news) ? $news->news_desc_ru : old('news_desc_ru') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta SEO description </label>
                                            <input type="text" class="form-control"
                                                name="news_meta_description_ru" value="{{ !empty($news) ? $news->news_meta_description_ru : old('news_meta_description_ru') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Meta SEO keywords</label>
                                            <input type="text" class="form-control"
                                                name="news_meta_keywords_ru" value="{{ !empty($news) ? $news->news_meta_keywords_ru : old('news_meta_keywords_ru') }}" />
                                        </div>
                                        <div class="form-group">
                                            <label>Тэги (через запятую)</label>
                                            <textarea name="tag_ru" class="form-control">{{ !empty($news) ? $news->tag_ru : old('tag_ru') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" class="form-control" name="news_name_kz" value="{{ !empty($news) ? $news->news_name_kz : old('news_name_kz') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea id="editor1" name="news_desc_kz">{{ !empty($news) ? $news->news_desc_kz : old('news_desc_kz') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta SEO description </label>
                                            <input type="text" class="form-control"
                                                name="news_meta_description_kz" value="{{ !empty($news) ? $news->news_meta_description_kz : old('news_meta_description_kz') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta SEO keywords</label>
                                            <input type="text" class="form-control"
                                                name="news_meta_keywords_kz" value="{{ !empty($news) ? $news->news_meta_keywords_kz : old('news_meta_keywords_kz') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Тэги (через запятую)</label>
                                            <textarea name="tag_kz" class="form-control">{{ !empty($news) ? $news->tag_kz : old('tag_kz') }}</textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <div class="form-group">
                                            <label>Название</label>
                                            <input type="text" class="form-control" name="news_name_en" value="{{ !empty($news) ? $news->news_name_en : old('news_name_en') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Описание</label>
                                            <textarea id="editor2" name="news_desc_en">{{ !empty($news) ? $news->news_desc_en : old('news_desc_en') }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta SEO description </label>
                                            <input type="text" class="form-control"
                                                name="news_meta_description_en" value="{{ !empty($news) ? $news->news_meta_description_en : old('news_meta_description_en') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Meta SEO keywords</label>
                                            <input type="text" class="form-control"
                                                name="news_meta_keywords_en" value="{{ !empty($news) ? $news->news_meta_keywords_en : old('news_meta_keywords_en') }}"/>
                                        </div>
                                        <div class="form-group">
                                            <label>Тэги (через запятую)</label>
                                            <textarea name="tag_en" class="form-control">{{ !empty($news) ? $news->tag_en : old('tag_en') }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Автор</label>
                                    <select class="form-control" name="author_id">
                                        @include('admin.layouts.users')
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Язык</label><br>
                                    <input class="form-check-input" id="ru" type="checkbox" value="ru"
                                        name="news_lang[]" {{ (!empty($news) && strpos($news->news_lang, 'ru') !== false) ? 'checked' : "" }}>
                                    <label for="ru">Русский</label>
                                    <input class="form-check-input" id="kz" type="checkbox" value="kz"
                                        name="news_lang[]" {{ (!empty($news) && strpos($news->news_lang, 'kz') !== false) ? 'checked' : "" }}>
                                    <label for="kz">Казахский</label>
                                    <input class="form-check-input" id="en" type="checkbox" value="en"
                                        name="news_lang[]" {{ (!empty($news) && strpos($news->news_lang, 'en') !== false) ? 'checked' : "" }}>
                                    <label for="en">Английский</label>
                                </div>
                                <div class="form-group">
                                    <label>Отображать</label><br>
                                    <input type="radio" class="form-check-input" name="is_show" value="1"
                                        id="is_show_yes" {{ (!empty($news) && $news->is_show == 1) ? "checked" : "checked" }}>
                                    <label class="form-check-label" for="is_show_yes">
                                        Да
                                    </label>
                                    <input type="radio" class="form-check-input" name="is_show" value="0"
                                        id="is_show_no" {{ (!empty($news) && $news->is_show == 0) ? "checked" : "" }}>
                                    <label class="form-check-label" for="is_show_no">
                                        Нет
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Рубрика</label>
                                    <select class="form-control" name="news_rubric_id">
                                        @include('admin.layouts.rubric')
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Позиция</label><br>
                                    @include('admin.layouts.position')
                                </div>
                                <div class="form-group">
                                    <label>Дата</label>
                                    <input type="date" class="form-control" name="news_date" value="{{ !empty($news) ? $news->news_date : old('news_date') }}">
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
                                    <img class="image-src" id="blah" src="{{ (!empty($news)) ? $news->news_image : "/img/default-image.jpg" }}" style="width: 100%; " />
                                </div>
                                <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                                <label class="btn btn-primary" for="imgInp">
                                    <input id="imgInp" type="file" name="news_image" class="d-none">
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
