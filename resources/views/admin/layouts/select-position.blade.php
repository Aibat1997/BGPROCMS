@php
    $position = App\Models\Position::all();
@endphp
    <option label="Выберите"></option>
@foreach ($position as $item)
    @if(!empty($banner))
    <option value="{{ $item->position_id }}" {{ ($banner->banner_position_id == $item->position_id) ? "selected" : "" }}>{{ $item->position_name_ru }}</option>
    @elseif(!empty($slider))
    <option value="{{ $item->position_id }}" {{ ($slider->slider_position == $item->position_id) ? "selected" : "" }}>{{ $item->position_name_ru }}</option>
    @else
    <option value="{{ $item->position_id }}">{{ $item->position_name_ru }}</option>
    @endif
@endforeach