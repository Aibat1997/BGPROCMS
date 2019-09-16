@php
    $rubric = App\Models\Rubric::all();
@endphp
    <option selected>Выберите</option>
@foreach ($rubric as $item)
    @if(!empty($banner))
        <option value="{{ $item->rubric_id }}" {{ ($banner->banner_rubric_id == $item->rubric_id) ? "selected" : "" }}>{{ $item->rubric_name_ru }}</option>
    @elseif(!empty($news))
        <option value="{{ $item->rubric_id }}" {{ ($news->news_rubric_id == $item->rubric_id) ? "selected" : "" }}>{{ $item->rubric_name_ru }}</option>
    @else
        <option value="{{ $item->rubric_id }}">{{ $item->rubric_name_ru }}</option>
    @endif
@endforeach