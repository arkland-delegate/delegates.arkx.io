<div class="mt-6">
    <button type="button" class="btn-green-plus"><i class="far fa-alarm-clock"></i></button>
    <span class="ml-4 font-bold">Voting - Fidelity</span>
</div>

<div class="mt-6">
    <label>Period</label>
    <input type="text" name="voting[fidelity][period]" value="{{ old('period', $delegate->voting['fidelity']['period']) }}" />
</div>

<div class="mt-6">
    <label>Share</label>
    <input type="number" name="voting[fidelity][share]" value="{{ old('share', $delegate->voting['fidelity']['share']) }}" />
</div>

<div class="mt-6">
    <label class="block mb-2">Additional Information</label>
    <textarea name="voting[fidelity][details]" class="markdown-editor">{{ old('voting[fidelity][details]', $delegate->voting['fidelity']['details']) }}</textarea>
</div>
