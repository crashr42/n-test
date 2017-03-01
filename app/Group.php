<?php

namespace App;

use Illuminate\Database\Eloquent\Collection;

/**
 * Class Group
 * @property integer id
 * @property Collection|User[] users
 * @property string name
 */
class Group extends Model
{
    protected $casts = [
        'id' => 'integer',
    ];

    protected $rules = [
        'name' => 'required|string|max:50',
    ];

    protected $fillable = [
        'name',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany|\Eloquent
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
