@extends('admin.layouts.layout')

@section('css')

@endsection

@section('content')
<div class="page-wrapper" style="min-height: 319px;">
  <div class="container-fluid">
    <div class="row page-titles">
      <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0 d-inline-block">
          <a>Позиции новостей</a>
        </h3>
      </div>
    </div>
    <div class="row white-bg">
      <div class="col-md-12">
        <div class="box-body">
          <div class="col-lg-12 col-md-12">
            <div class="card">
              <div class="card-block">
                <form action="" method="POST" id="createForm" class="box-body d-flex align-items-center">
                  @csrf
                  <div class="form-group col-lg-3">
                    <label>Название(ru)</label>
                    <input type="text" class="form-control" name="position_name_ru" />
                  </div>
                  <div class="form-group col-lg-3">
                    <label>Название(ru)</label>
                    <input type="text" class="form-control" name="position_name_kz" />
                  </div>
                  <div class="form-group col-lg-3">
                    <label>Название(ru)</label>
                    <input type="text" class="form-control" name="position_name_en" />
                  </div>
                  <div class="form-group col-lg-3 m-b-0">
                    <button class="btn btn-primary">Сохранить</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <div class="table-responsive">
            <table id="showed" class="table table-bordered table-striped">
              <thead>
                <tr style="border: 1px">
                  <th style="width: 30px">№</th>
                  <th>Название(ru)</th>
                  <th>Название(kz)</th>
                  <th>Название(en)</th>
                  <th></th>
                  <th></th>
                </tr>
              </thead>

              <tbody id="position_table">
                @foreach ($position as $key=>$value)
                <tr>
                  <form action="" method="POST" id="updateForm{{ $value->position_id }}">
                    @csrf
                    <input type="hidden" name="position_id" value="{{ $value->position_id }}">
                    <td>{{ $key+1 }}</td>
                    <td><input type="text" class="form-control" name="position_name_ru" value="{{ $value->position_name_ru }}" /></td>
                    <td><input type="text" class="form-control" name="position_name_kz" value="{{ $value->position_name_kz }}" /></td>
                    <td><input type="text" class="form-control" name="position_name_en" value="{{ $value->position_name_en }}" /></td>
                    <td><button class="btn btn-primary">Сохранить</button></td>
                    <td>
                      <a href="javascript:void(0)" onclick="remove(this,'{{ $value->position_id }}','position')">
                        <i class="fas fa-trash"></i>
                      </a>
                    </td>
                  </form>
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
<script>
  $(document).ready(function () {
    $('form').on('submit', function (e) {
      e.preventDefault();
      sendAjaxForm(this.id, '/admin/position');
      return false;
    });
  });

  function sendAjaxForm(ajax_form, url) {
    $.ajax({
      url: url,
      type: "POST",
      dataType: "html",
      data: $("#" + ajax_form).serialize(),
      success: function (response) {
        var result = $.parseJSON(response);
        $('#position_table').append(
          `<tr>
            <form action="" method="post" id="updateForm`+ result.position_id  + `">
             @csrf
             <input type="hidden" name="position_id " value="`+ result.position_id  + `">
             <td>`+ result.position_id  + `</td>
             <td><input type="text" class="form-control" name="position_name_ru" value="`+ result.position_name_ru + `" /></td>
             <td><input type="text" class="form-control" name="position_name_kz" value="`+ result.position_name_kz + `" /></td>
             <td><input type="text" class="form-control" name="position_name_en" value="`+ result.position_name_en + `" /></td>
             <td><button class="btn btn-primary">Сохранить</button></td>
             <td>
               <a href="javascript:void(0)" onclick="remove(this,'`+ result.position_id  + `','position')">
                 <i class="fas fa-trash"></i>
               </a>
             </td>
            </form>
           </tr>`
        );
      },
      error: function (response) {

      }
    });
  }
</script>
@endsection
