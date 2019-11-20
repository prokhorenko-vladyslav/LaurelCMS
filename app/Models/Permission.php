<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'model_name'
    ];

    public function setModelName(string $model_name)
    {
        $this->model_name = $model_name;

        return $this;
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public static function checkModel(string $modelName)
    {
        if (class_exists($modelName))
            return true;
        else
            throw new \Exception("Model for permission doesn`t exists");
    }

    public static function generate(string $modelName)
    {
        self::checkModel($modelName);
        $permission = new self;
        $permission->setModelName($modelName);
        $permission->save();
        return $permission;
    }

    public static function getByModelName(string $modelName)
    {
        return self::where('model_name', $modelName)->firstOrFail();
    }
}
