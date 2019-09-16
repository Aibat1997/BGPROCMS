@extends('admin.layouts.layout')

@section('css')
@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0">
                    Добавить архив
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/archive" class="btn btn-danger">Назад</a>
            </div>
        </div>
        <div class="row">
            @if(empty($archive))
            <form class="col-lg-12 col-md-12 row" action="/admin/archive" method="POST" enctype="multipart/form-data">
            @else 
            <form class="col-lg-12 col-md-12 row" action="/admin/archive/{{ $archive->archive_id }}" method="POST" enctype="multipart/form-data">
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
                                <div class="form-group files" id="files1">
                                    <span class="btn btn-success btn-file">
                                        Добавить файл
                                        <input type="file" name="archive_file[]" multiple />
                                    </span>
                                    <br />
                                    <ul class="fileList m-t-20">
                                        @if(!empty($archive))
                                        @php
                                            $pice = str_replace("'", "", substr($archive->archive_file, 0, -1));
                                            $links = explode(",", $pice);
                                        @endphp
                                        @foreach ($links as $item)
                                        <li>
                                            <strong>{{ $item }}</strong>&nbsp; &nbsp; 
                                            <a class="removeFile text-danger" href="#" data-fileid="0">✕</a>
                                        </li>                                            
                                        @endforeach
                                        @endif
                                    </ul>
                                </div>
                                <div class="form-group">
                                    <label>Отображать</label><br>
                                    <input type="radio" class="form-check-input" name="is_show" value="1"
                                        id="is_show_yes" {{ (!empty($archive) && $archive->is_show == 1) ? "checked" : "checked" }}>
                                    <label class="form-check-label" for="is_show_yes">
                                        Да
                                    </label>
                                    <input type="radio" class="form-check-input" name="is_show" value="0"
                                        id="is_show_no" {{ (!empty($archive) && $archive->is_show == 0) ? "checked" : "" }}>
                                    <label class="form-check-label" for="is_show_no">
                                        Нет
                                    </label>
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
                                    <img class="image-src" id="blah" src="{{ !empty($archive) ? $archive->archive_image : "" }}" style="width: 100%;" />
                                </div>
                                <div style="background-color: #c2e2f0;height: 40px;margin: 0 auto;width: 2px;"></div>
                                <label class="btn btn-primary" for="imgInp">
                                    <input id="imgInp" type="file" name="archive_image" class="d-none">
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

@section('js')
<script src="/js/fileupload.js"></script>
<script>
    $("#files1").fileUploader(filesToUpload);
</script>
@endsection