<div class="mt-6">
    <button type="button" class="btn-green-plus"><i class="far fa-key"></i></button>
    <span class="ml-4 font-bold">Voting - Requirements</span>
</div>

<div class="mt-6">
    <label>Minimum Balance</label>
    <input type="number" name="voting[requirements][min_balance]" value="{{ old('min_balance', $delegate->voting['requirements']['min_balance']) }}" step="0.1" />
</div>

<div class="mt-6">
    <label>Maximum Balance</label>
    <input type="number" name="voting[requirements][max_balance]" value="{{ old('max_balance', $delegate->voting['requirements']['max_balance']) }}" step="0.1" />
</div>

<div class="mt-6">
    <label class="w-full select">
        Requires Registration
        {{ html()->select('voting[requirements][registration]', [
            'yes' => 'Yes',
            'no' => 'No'
        ], $delegate->voting['requirements']['registration']) }}
    </label>
</div>

<div class="mt-6">
    <label class="block mb-2">Additional Information</label>
    <textarea name="voting[requirements][details]" class="markdown-editor">{{ old('voting[requirements][details]', $delegate->voting['requirements']['details']) }}</textarea>
</div>
