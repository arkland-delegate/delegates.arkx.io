<div class="mt-6">
    <button type="button" class="btn-green-plus"><i class="far fa-percentage"></i></button>
    <span class="ml-4 font-bold">Profit Sharing</span>
</div>

<div class="mt-6">
    <label>Share</label>
    <input type="number" name="sharing[percentage]" value="{{ old('percentage', $delegate->sharing['percentage']) }}" />
</div>

<div class="mt-6">
    <label>Frequency</label>
    <input type="text" name="sharing[frequency]" value="{{ old('frequency', $delegate->sharing['frequency']) }}" />
</div>

<div class="mt-6">
    <label>Threshold</label>
    <input type="number" name="sharing[threshold]" value="{{ old('threshold', $delegate->sharing['threshold']) }}" step="0.1" />
</div>

<div class="mt-6">
    <label class="w-full select">
        Running Balance
        {{ html()->select('sharing[running_balance]', [
            'yes' => 'Yes',
            'no' => 'No'
        ], $delegate->sharing['running_balance']) }}
    </label>
</div>

<div class="mt-6">
    <label class="w-full select">
        Covers Fee
        {{ html()->select('sharing[covers_fee]', [
            'yes' => 'Yes',
            'no' => 'No'
        ], $delegate->sharing['covers_fee']) }}
    </label>
</div>

<div class="mt-6">
    <label class="block mb-2">Additional Information</label>
    <textarea name="sharing[details]" class="markdown-editor">{{ old('sharing[details]', $delegate->sharing['details']) }}</textarea>
</div>
