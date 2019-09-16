@extends('admin.layouts.layout')

@section('css')
<style>
    td img {
        width: 85px;
        height: 85px;
    }
</style>
@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
    <div class="container-fluid">
        <div class="row page-titles">
            <div class="col-md-8 col-8 align-self-center">
                <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block">
                    <a>Слайдер</a>
                </h3>
            </div>
            <div class="col-md-4 col-4 align-self-center text-right">
                <a href="/admin/slider/create" class="btn btn-success">Добавить</a>
            </div>
        </div>
        <div class="row page-titles">
            <div class="col-md-12 col-12 align-self-center">
                <h5 class="text-themecolor m-b-0 m-t-0 d-inline-block active-top-show">
                    <a class="show">Опубликованные слайды</a>
                    </h3>
                    <h5 class="text-themecolor m-b-0 m-t-0 m-l-20 d-inline-block">
                        <a class="not-show">Неопубликованные слайды</a>
                    </h5>
                    <div class="clear-float"></div>
            </div>
        </div>

        <div class="row white-bg">
            <div class="col-md-12">
                <div class="box-body">
                    <div class="table-responsive">
                        <table id="showed" class="table table-bordered table-striped">
                            <thead>
                                <tr style="border: 1px">
                                    <th style="width: 30px">№</th>
                                    <th>Картинка</th>
                                    <th>Название</th>
                                    <th>Позиция</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($slider as $value)
                                <tr>
                                    <td>{{ $value->slider_id }}</td>
                                    <td><img src="{{ $value->slider_image_ru }}" alt=""></td>
                                    <td>{{ $value->slider_text_ru }}</td>
                                    <td>{{ $value->position_name_ru }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="remove(this,'{{ $value->slider_id }}','slider')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td><a href="/admin/slider/{{ $value->slider_id }}/edit"><i class="fas fa-pen"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="table-responsive">
                        <table id="not-showed" class="table table-bordered table-striped">
                            <thead>
                                <tr style="border: 1px">
                                    <th style="width: 30px">№</th>
                                    <th>Картинка</th>
                                    <th>Название</th>
                                    <th>Позиция</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($slider_not as $value)
                                <tr>
                                    <td>{{ $value->slider_id }}</td>
                                    <td><img src="{{ $value->slider_image_ru }}" alt=""></td>
                                    <td>{{ $value->slider_text_ru }}</td>
                                    <td>{{ $value->position_name_ru }}</td>
                                    <td>
                                        <a href="javascript:void(0)"
                                            onclick="remove(this,'{{ $value->slider_id }}','slider')">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                    <td><a href="/admin/slider/{{ $value->slider_id }}/edit"><i class="fas fa-pen"></i></a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
@endsection