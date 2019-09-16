@extends('admin.layouts.layout')

@section('css')
<style>
td img{
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
          <a>Архив</a>
        </h3>
      </div>
      <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/archive/create" class="btn btn-success">Добавить</a>
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
                  <th>Файл</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($archive as $value)
                <tr>
                  <td>{{ $value->archive_id }}</td>
                  <td><img src="{{ $value->archive_image }}" alt=""></td>
                  @php
                      $pice = str_replace("'", "", substr($value->archive_file, 0, -1));
                      $links = explode(",", $pice);
                  @endphp
                  <td>
                    @foreach ($links as $item)
                        <a href="{{ $item }}" target="_blank">{{ $item}}</a>,
                    @endforeach
                  </td>
                  <td>
                    <a href="javascript:void(0)" onclick="remove(this,'{{ $value->archive_id }}','archive')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                  <td><a href="/admin/archive/{{ $value->archive_id }}/edit"><i class="fas fa-pen"></i></a></td>
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