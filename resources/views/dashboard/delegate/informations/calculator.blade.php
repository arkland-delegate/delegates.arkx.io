<div class="mt-6">
    <button type="button" class="btn-green-plus"><i class="far fa-function"></i></button>
    <span class="ml-4 font-bold">Calculator</span>
</div>

<div class="mt-6">
    <label class="w-full select">
        Cap at Maximum Balance
        {{ html()->select('calculator[cap_at_maximum_balance]', [
            'yes' => 'Yes',
            'no' => 'No'
        ], $delegate->calculator['cap_at_maximum_balance']) }}
    </label>
</div>

<div class="mt-6">
    <label class="w-full select">
        Ignore above Maximum Balance
        {{ html()->select('calculator[ignore_above_maximum_balance]', [
            'yes' => 'Yes',
            'no' => 'No'
        ], $delegate->calculator['ignore_above_maximum_balance']) }}
    </label>
</div>

<div class="mt-6">
    <label class="block mb-2">Additional Information</label>
    <textarea name="calculator[details]" class="markdown-editor">{{ old('calculator[details]', $delegate->calculator['details']) }}</textarea>
</div>
