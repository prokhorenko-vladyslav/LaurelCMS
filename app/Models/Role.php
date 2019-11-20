<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    private const ENABLED = 1;
    private const DISABLED = 0;
    private const DEFAULT_STATUS = 0;

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
                $permission = Permission::getByModelName($modelName);
            } catch (\Exception $e) {
                $permission = Permission::generate($modelName);
            }
        }

        return $permission;
    }

    public function grantBrowseAccess(string $modelName, bool $value = self::ENABLED)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $value,
                'read' => $permission->pivot->read ?? self::DEFAULT_STATUS,
                'add' => $permission->pivot->add ?? self::DEFAULT_STATUS,
                'edit' => $permission->pivot->edit ?? self::DEFAULT_STATUS,
                'delete' => $permission->pivot->delete ?? self::DEFAULT_STATUS
            ]
        ]);
        return $this;
    }

    public function grantReadAccess(string $modelName, bool $value = self::ENABLED)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse  ?? self::DEFAULT_STATUS,
                'read' => $value,
                'add' => $permission->pivot->add ?? self::DEFAULT_STATUS,
                'edit' => $permission->pivot->edit ?? self::DEFAULT_STATUS,
                'delete' => $permission->pivot->delete ?? self::DEFAULT_STATUS
            ]
        ]);
        return $this;
    }

    public function grantAddAccess(string $modelName, bool $value = self::ENABLED)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse  ?? self::DEFAULT_STATUS,
                'read' => $permission->pivot->read ?? self::DEFAULT_STATUS,
                'add' => $value,
                'edit' => $permission->pivot->edit ?? self::DEFAULT_STATUS,
                'delete' => $permission->pivot->delete ?? self::DEFAULT_STATUS
            ]
        ]);
        return $this;
    }

    public function grantEditAccess(string $modelName, bool $value = self::ENABLED)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse  ?? self::DEFAULT_STATUS,
                'read' => $permission->pivot->read ?? self::DEFAULT_STATUS,
                'add' => $permission->pivot->add ?? self::DEFAULT_STATUS,
                'edit' => $value,
                'delete' => $permission->pivot->delete ?? self::DEFAULT_STATUS
            ]
        ]);
        return $this;
    }

    public function grantDeleteAccess(string $modelName, bool $value = self::ENABLED)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse  ?? self::DEFAULT_STATUS,
                'read' => $permission->pivot->read ?? self::DEFAULT_STATUS,
                'add' => $permission->pivot->add ?? self::DEFAULT_STATUS,
                'edit' => $permission->pivot->edit ?? self::DEFAULT_STATUS,
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
                'browse'    => self::ENABLED,
                'read'      => self::ENABLED,
                'add'       => self::ENABLED,
                'edit'      => self::ENABLED,
                'delete'    => self::ENABLED
            ]
        ]);
        return $this;
    }

    public function disableAccess(string $modelName)
    {
        $permission = $this->processPermission($modelName);
        $this->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse'    => self::DISABLED,
                'read'      => self::DISABLED,
                'add'       => self::DISABLED,
                'edit'      => self::DISABLED,
                'delete'    => self::DISABLED
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
            return self::DISABLED;
        }
    }

    public function canRead(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->read;
        } catch (\Exception $e) {
            return self::DISABLED;
        }
    }

    public function canAdd(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->add;
        } catch (\Exception $e) {
            return self::DISABLED;
        }
    }

    public function canEdit(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->edit;
        } catch (\Exception $e) {
            return self::DISABLED;
        }
    }

    public function canDelete(string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return (bool)$permission->pivot->delete;
        } catch (\Exception $e) {
            return self::DISABLED;
        }
    }

    public function hasAccess(string $action, string $modelName)
    {
        try {
            $permission = $this->getPermissionByModelName($modelName);
            return in_array($action, Permission::PERMISSIONS) ? (bool)$permission->pivot->$action : self::DISABLED;
        } catch (\Exception $e) {
            return self::DISABLED;
        }
    }
}
