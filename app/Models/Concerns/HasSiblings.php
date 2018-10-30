<?php

namespace App\Models\Concerns;

use Illuminate\Database\Eloquent\Model;

trait HasSiblings
{
    /**
     * Get the preceding entity.
     *
     * @return null|\Illuminate\Database\Eloquent\Model
     */
    public function previous(): ?Model
    {
        return $this
            ->where('id', '<', $this->id)
            ->orderBy('id', 'desc')
            ->first();
    }

    /**
     * Get the next entity.
     *
     * @return null|\Illuminate\Database\Eloquent\Model
     */
    public function next(): ?Model
    {
        return $this
            ->where('id', '>', $this->id)
            ->orderBy('id')
            ->first();
    }

    /**
     * Check if the entity is preceded by a record.
     *
     * @return bool
     */
    public function hasPrevious(): bool
    {
        return !empty($this->previous());
    }

    /**
     * Check if the entity is followed by a record.
     *
     * @return bool
     */
    public function hasNext(): bool
    {
        return !empty($this->next());
    }
}
