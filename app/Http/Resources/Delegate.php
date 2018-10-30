<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Delegate extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'type'             => $this->type,
            'username'         => $this->username,
            'address'          => $this->address,
            'public_key'       => $this->public_key,
            'rank'             => $this->rank,
            'votes'            => $this->votes,
            'country'          => new Country($this->country),
            'extra_attributes' => $this->extra_attributes->toArray(),
        ];
    }
}
