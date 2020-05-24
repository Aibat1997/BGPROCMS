@php
    $position = App\Models\Position::all();
@endphp
@foreach ($position as $item)
    @if (!empty($news))
        <input class="form-check-input" id="item{{ $item->position_id }}" type="checkbox" value="{{ $item->position_id }}" name="news_position[]"
        {{ $news->positions()->where('position_id', $item->position_id)->exists() ? 'checked' : ''}}>
        <label for="item{{ $item->position_id }}">{{ $item->position_name_ru }}</label> 
    @elseif (!empty($banner))
        <input class="form-check-input" id="item{{ $item->position_id }}" type="checkbox" value="{{ $item->position_id }}" name="news_position[]"
        {{ $banner->positions()->where('position_id', $item->position_id)->exists() ? 'checked' : ''}}>
        <label for="item{{ $item->position_id }}">{{ $item->position_name_ru }}</label> 
    @else
        <input class="form-check-input" id="item{{ $item->position_id }}" type="checkbox" value="{{ $item->position_id }}" name="news_position[]">
        <label for="item{{ $item->position_id }}">{{ $item->position_name_ru }}</label>    
    @endif
@endforeach