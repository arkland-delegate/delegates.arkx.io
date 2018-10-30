<?php

namespace App\Http\Requests\Dashboard\Delegate;

use Illuminate\Validation\Rule;

class UpdateDelegate extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'type'                                    => ['required', Rule::in(['public', 'private', 'hybrid'])],
            'country_id'                              => ['required', Rule::exists('countries', 'id')],
            'tags'                                    => ['nullable', 'string'],
            'logo'                                    => ['image'],

            'calculator.cap_at_maximum_balance'       => ['required', Rule::in(['yes', 'no'])],
            'calculator.ignore_above_maximum_balance' => ['required', Rule::in(['yes', 'no'])],
            'calculator.details'                      => ['nullable', 'string'],

            'profile.proposal'                        => ['nullable', 'url'],
            'profile.website'                         => ['nullable', 'url'],
            'profile.details'                         => ['nullable', 'string'],

            'sharing.percentage'                      => ['required', 'numeric', 'min:0', 'max:100'],
            'sharing.frequency'                       => ['required', 'string'],
            'sharing.threshold'                       => ['required', 'numeric', 'min:0'],
            'sharing.running_balance'                 => ['required', Rule::in(['yes', 'no'])],
            'sharing.covers_fee'                      => ['required', Rule::in(['yes', 'no'])],
            'sharing.details'                         => ['nullable', 'string'],

            'voting.fidelity.period'                  => ['nullable', 'string'],
            'voting.fidelity.share'                   => ['nullable', 'numeric', 'max:100'],
            'voting.fidelity.details'                 => ['nullable', 'string'],

            'voting.requirements.details'             => ['nullable', 'string'],
            'voting.requirements.max_balance'         => ['required', 'numeric', 'min:0'],
            'voting.requirements.min_balance'         => ['required', 'numeric', 'min:0'],
            'voting.requirements.registration'        => ['required', Rule::in(['yes', 'no'])],
        ];
    }
}
