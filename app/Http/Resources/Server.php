<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Server extends JsonResource
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
            'id'         => $this->id,
            'type'       => $this->type,
            'network'    => $this->network,
            'cpu'        => $this->cpu,
            'ram'        => $this->ram,
            'disk'       => $this->disk,
            'connection' => $this->connection,
            'country'    => new Country($this->country),
        ];
    }
}
