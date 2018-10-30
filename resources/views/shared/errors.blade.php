@if (count($errors) > 0)
    <div class="alert-danger m-6 mb-0">
        <p><strong>Whoops!</strong> Something went wrong!</p>

        <ul class="text-sm mt-3">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
