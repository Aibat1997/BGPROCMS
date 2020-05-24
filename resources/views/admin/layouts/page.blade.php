@php
    $page = App\Models\Page::where('is_show', 1)->get();
@endphp
    <option label="Выберите"></option>
@foreach ($page as $item)
    @if(!empty($menu))
    <option value="{{ $item->page_id }}" {{ ($menu->menu_page_id == $item->page_id) ? "selected" : "" }}>{{ $item->page_name_ru }}</option>
    @else
    <option value="{{ $item->page_id }}">{{ $item->page_name_ru }}</option>
    @endif
@endforeach