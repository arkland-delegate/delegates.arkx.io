<form class="inline-block" action="{{ $action }}" method="POST">
    @csrf
    @method('DELETE')

    <button type="submit" class="link-icon">
        <i class="far fa-times-hexagon"></i>
    </button>
</form>
