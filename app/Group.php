<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Group
 * @property integer id
 * @property string name
 * @property Collection|User[] users
 */
class Group extends Model
{
    protected $casts = [
        'id' => 'integer',
    ];

    protected $rules = [
        'name' => 'required|string|max:50',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
