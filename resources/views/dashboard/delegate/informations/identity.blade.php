<div class="mt-6">
    <button type="button" class="btn-green-plus"><i class="far fa-passport"></i></button>
    <span class="ml-4 font-bold">Identity</span>
</div>

<div class="mt-6">
    <label class="w-full select">
        Type
        {{ html()->select('type', [
            'public' => 'Public',
            'private' => 'Private',
            'hybrid' => 'Hybrid',
        ], $delegate->type) }}
    </label>
</div>

<div class="mt-6">
    <label class="w-full select">
        Country
        {{ html()->select('country_id', $countries, $delegate->country_id) }}
    </label>
</div>
