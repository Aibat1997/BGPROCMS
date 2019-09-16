@extends('admin.layouts.layout')

@section('css')

@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block">
          <a>Меню</a>
        </h3>
      </div>
      <div class="col-md-4 col-4 align-self-center text-right">
        <a href="/admin/menu/create" class="btn btn-success">Добавить</a>
      </div>
    </div>
    <div class="row page-titles">
      <div class="col-md-12 col-12 align-self-center">
        <h5 class="text-themecolor m-b-0 m-t-0 d-inline-block active-top-show">
          <a class="show">Опубликованные меню</a>
          </h3>
          <h5 class="text-themecolor m-b-0 m-t-0 m-l-20 d-inline-block">
            <a class="not-show">Неопубликованные меню</a>
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
                  <th>Название(ru)</th>
                  <th>Ссылка</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($menu as $value)
                <tr>
                  <td>{{ $value->menu_id }}</td>
                  <td>{{ $value->menu_name_ru }}</td>
                  <td>{{ $value->menu_url }}</td>
                  <td>
                    <a href="javascript:void(0)" onclick="remove(this,'{{ $value->menu_id }}','menu')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                  <td><a href="/admin/menu/{{ $value->menu_id }}/edit"><i class="fas fa-pen"></i></a></td>
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
                  <th>Название(ru)</th>
                  <th>Ссылка</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody>
                @foreach ($menu_not as $value)
                <tr>
                  <td>{{ $value->menu_id }}</td>
                  <td>{{ $value->menu_name_ru }}</td>
                  <td>{{ $value->menu_url }}</td>
                  <td>
                    <a href="javascript:void(0)" onclick="remove(this,'{{ $value->menu_id }}','menu')">
                      <i class="fas fa-trash"></i>
                    </a>
                  </td>
                  <td><a href="/admin/menu/{{ $value->menu_id }}/edit"><i class="fas fa-pen"></i></a></td>
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