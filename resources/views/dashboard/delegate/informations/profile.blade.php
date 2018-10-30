<div class="mt-6">
    <button type="button" class="btn-green-plus"><i class="far fa-user-tie"></i></button>
    <span class="ml-4 font-bold">Profile</span>
</div>

<div class="mt-6">
    <label>Proposal</label>
    <input type="url" name="profile[proposal]" value="{{ old('proposal', $delegate->profile['proposal']) }}" />
</div>

<div class="mt-6">
    <label>Website</label>
    <input type="url" name="profile[website]" value="{{ $delegate->profile['website'] }}" />
</div>

<div class="mt-6">
    <label>Tags</label>
    <input type="text" name="tags" value="{{ $delegate->glued_tags }}" />
    <div class="pt-2">
        <em class="inline-block bg-yellow p-2">
            Write your tags, separated by commas with no spaces between the end and beginning of a tag and it's separating comma (i.e. tag 1,tag 2,tag 3).
        </em>
    </div>
</div>

<div class="mt-6">
    <label>Logo</label>
    <input type="file" name="logo" />

    @if(isset($delegate->profile['logo']))
        <em class="inline-block bg-yellow p-2 mt-2">
            <a href="{{ asset($delegate->logo) }}" target="_blank">
                {{ asset($delegate->logo) }}
            </a>
        </em>
    @endif
</div>

<div class="mt-6">
    <label class="block mb-2">Additional Information</label>
    <textarea name="profile[details]" class="markdown-editor">{{ old('profile[details]', $delegate->profile['details']) }}</textarea>
</div>
