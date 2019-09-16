@php
    if(empty($menu)){
        $menu_list = App\Models\Menu::where('is_show', 1)->get();
    }else {
        $menu_list = App\Models\Menu::where('is_show', 1)->where('menu_id', '!=',  $menu->menu_id)->get();        
    }
@endphp
    <option selected>Выберите</option>
@foreach ($menu_list as $item)
    @if(!empty($menu))
    <option value="{{ $item->menu_id }}" {{ ($menu->main_menu_id == $item->menu_id) ? "selected" : "" }}>{{ $item->menu_name_ru }}</option>
    @else
    <option value="{{ $item->menu_id }}">{{ $item->menu_name_ru }}</option>
    @endif
@endforeach