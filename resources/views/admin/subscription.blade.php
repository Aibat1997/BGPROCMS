@extends('admin.layouts.layout')

@section('css')
    
@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
    <div class="container-fluid">
      <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
          <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block">
            <a>Подписка</a>
          </h3>
        </div>
      </div>
  
      <div class="row white-bg">
        <div class="col-md-12">
          <div class="box-body">
            <table id="showed" class="table table-bordered table-striped">
              <thead>
                <tr style="border: 1px">
                  <th style="width: 30px">№</th>
                  <th>Email</th>
                  <th>Рубрика</th>
                  <th>Статус</th>
                  <th></th>
                </tr>
              </thead>
  
              <tbody>
                  @foreach ($subscription as $value)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $value->subscription_user_email }}</td>
                          <td>{{ $value->rubric_name_ru }}</td>
                          <td>{{ $value->subscription_status }}</td>
                          <td>
                            <a href="javascript:void(0)" onclick="remove(this,'{{ $value->subscription_id }}','subscription')">
                              <i class="fas fa-trash"></i>
                            </a>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@section('js')
@endsection