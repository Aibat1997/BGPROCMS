@php
    $user = App\Models\User::all();
@endphp
    <option label="Выберите"></option>
@foreach ($user as $item)
    @if(!empty($news))
    <option value="{{ $item->user_id }}" {{ ($news->author_id == $item->user_id) ? "selected" : "" }}>{{ $item->full_name }}</option>
    @else
    <option value="{{ $item->user_id }}">{{ $item->full_name }}</option>
    @endif
@endforeach