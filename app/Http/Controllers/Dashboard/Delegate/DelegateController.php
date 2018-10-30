<?php

namespace App\Http\Controllers\Dashboard\Delegate;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Delegate\UpdateDelegate;
use App\Models\Country;
use App\Models\Delegate;
use Illuminate\Support\Facades\Storage;

class DelegateController extends Controller
{
    public function edit(Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        $countries = Country::pluck('name', 'id')->sort();

        return view('dashboard.delegate.informations', compact('delegate', 'countries'));
    }

    public function update(UpdateDelegate $request, Delegate $delegate)
    {
        $this->authorize('update', $delegate);

        // Valid data
        $data = $request->validated();

        // Update model
        $delegate->update(array_only($data, ['type', 'country_id']));

        // Update tags
        if ($request->get('tags')) {
            $tags = explode(',', $request->get('tags'));

            $delegate->syncTags(array_map('trim', $tags));
        }

        // Old Logo
        $currentLogo = $delegate->extra_attributes->get('profile.logo');

        // Update Meta
        $delegate->extra_attributes->set('calculator', $data['calculator']);
        $delegate->extra_attributes->set('profile', $data['profile']);
        $delegate->extra_attributes->set('sharing', $data['sharing']);
        $delegate->extra_attributes->set('voting', $data['voting']);

        // Upload logo
        if ($request->hasFile('logo')) {
            $logo = Storage::disk('public')->putFile('logos', $request->file('logo'));

            $delegate->extra_attributes->set('profile.logo', $logo);
        } else {
            $delegate->extra_attributes->set('profile.logo', $currentLogo);
        }

        // Save
        $delegate->save();

        alert()->success('Your delegate information is being updated! The changes should be reflected in a moment.');

        return redirect()->back();
    }
}
