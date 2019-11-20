<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public function permissions()
    {
        return $this->belongsToMany(Permission::class)->withPivot(['browse', 'read', 'add', 'edit', 'delete']);
    }

    public static function getByName(string $name)
    {
        return self::where('name', $name)->firstOrFail();
    }

    public function getPermissionByModelName(string $modelName)
    {
        return self::permissions()->where('model_name', $modelName)->firstOrFail();
    }
}
