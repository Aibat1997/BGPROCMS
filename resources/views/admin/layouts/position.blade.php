@php
    $position = App\Models\Position::all();
@endphp
@foreach ($position as $item)
    @if (!empty($news))
    @php
        $news_pos = App\Models\NewsPosition::where('np_news_id', $news->news_id)->where('np_position_id', $item->position_id)->first();
    @endphp
        @if(!empty($news_pos))
            <input class="form-check-input" id="item{{ $item->position_id }}" type="checkbox" value="{{ $item->position_id }}" name="news_position[]" checked>
            <label for="item{{ $item->position_id }}">{{ $item->position_name_ru }}</label> 
        @else
            <input class="form-check-input" id="item{{ $item->position_id }}" type="checkbox" value="{{ $item->position_id }}" name="news_position[]">
            <label for="item{{ $item->position_id }}">{{ $item->position_name_ru }}</label> 
        @endif      
    @elseif (!empty($banner))
    @php
        $ban_pos = App\Models\BannerPosition::where('bp_banner_id', $banner->banner_id)->where('bp_position_id', $item->position_id)->first();
    @endphp
        @if(!empty($ban_pos))
            <input class="form-check-input" id="item{{ $item->position_id }}" type="checkbox" value="{{ $item->position_id }}" name="news_position[]" checked>
            <label for="item{{ $item->position_id }}">{{ $item->position_name_ru }}</label> 
        @else
            <input class="form-check-input" id="item{{ $item->position_id }}" type="checkbox" value="{{ $item->position_id }}" name="news_position[]">
            <label for="item{{ $item->position_id }}">{{ $item->position_name_ru }}</label> 
        @endif      
    @else
        <input class="form-check-input" id="item{{ $item->position_id }}" type="checkbox" value="{{ $item->position_id }}" name="news_position[]">
        <label for="item{{ $item->position_id }}">{{ $item->position_name_ru }}</label>    
    @endif
@endforeach