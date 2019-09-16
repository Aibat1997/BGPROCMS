@php
    $user = App\Models\User::all();
@endphp
    <option selected>Выберите</option>
@foreach ($user as $item)
    @if(!empty($news))
    <option value="{{ $item->user_id }}" {{ ($news->author_id == $item->user_id) ? "selected" : "" }}>{{ $item->user_name_ru }}</option>
    @else
    <option value="{{ $item->user_id }}">{{ $item->user_name_ru }}</option>
    @endif
@endforeach