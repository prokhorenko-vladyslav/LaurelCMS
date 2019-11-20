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
        return $this->permissions()->where('model_name', $modelName)->firstOrFail();
    }

    protected function processPermission(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
        } catch (\Exception $e) {
            try {
                $permission = self::getByModelName($modelName);
            } catch (\Exception $e) {
                $permission = self::generate($modelName);
            }
        }

        return $permission;
    }

    public function grantBrowseAccess(string $modelName, bool $value = true)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $value,
                'read' => $permission->pivot->read ?? 0,
                'add' => $permission->pivot->add ?? 0,
                'edit' => $permission->pivot->edit ?? 0,
                'delete' => $permission->pivot->delete ?? 0
            ]
        ]);
        return $this;
    }

    public function grantReadAccess(string $modelName, bool $value = true)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse  ?? 0,
                'read' => $value,
                'add' => $permission->pivot->add ?? 0,
                'edit' => $permission->pivot->edit ?? 0,
                'delete' => $permission->pivot->delete ?? 0
            ]
        ]);
        return $this;
    }

    public function grantAddAccess(string $modelName, bool $value = true)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse  ?? 0,
                'read' => $permission->pivot->read ?? 0,
                'add' => $value,
                'edit' => $permission->pivot->edit ?? 0,
                'delete' => $permission->pivot->delete ?? 0
            ]
        ]);
        return $this;
    }

    public function grantEditAccess(string $modelName, bool $value = true)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse  ?? 0,
                'read' => $permission->pivot->read ?? 0,
                'add' => $permission->pivot->add ?? 0,
                'edit' => $value,
                'delete' => $permission->pivot->delete ?? 0
            ]
        ]);
        return $this;
    }

    public function grantDeleteAccess(string $modelName, bool $value = true)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse  ?? 0,
                'read' => $permission->pivot->read ?? 0,
                'add' => $permission->pivot->add ?? 0,
                'edit' => $permission->pivot->edit ?? 0,
                'delete' => $value
            ]
        ]);
        return $this;
    }

    public function grantAccess(string $modelName)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse'    => 1,
                'read'      => 1,
                'add'       => 1,
                'edit'      => 1,
                'delete'    => 1
            ]
        ]);
        return $this;
    }

    public function disableAccess(string $modelName)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse'    => 0,
                'read'      => 0,
                'add'       => 0,
                'edit'      => 0,
                'delete'    => 0
            ]
        ]);
        return $this;
    }

    public function canBrowse(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->browse;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function canRead(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->read;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function canAdd(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->add;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function canEdit(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->edit;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function canDelete(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->delete;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function can(string $action, string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return isset($permission->pivot->$action) ? (bool)$permission->pivot->$action : false;
        } catch (\Exception $e) {
            return false;
        }
    }
}
