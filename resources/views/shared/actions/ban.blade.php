@php
    $action = $model->is_banned ? $unban['action'] : $ban['action'];
    $icon = $model->is_banned ? $unban['icon'] : $ban['icon'];
@endphp

<form class="inline-block" action="{{ route($action, $model) }}" method="POST">
    @csrf

    <button type="submit" class="link-icon">
        <i class="far {{ $icon }}"></i>
    </button>
</form>

{{-- @php
    $action = $model->is_banned ? $unban['action'] : $ban['action'];
    $text = $model->is_banned ? 'Unban' : 'Ban';
@endphp

<form class="inline-block" action="{{ route($action, $model) }}" method="POST">
    @csrf

    <button type="submit" class="button-red">
        {{ $text }}
    </button>
</form> --}}
