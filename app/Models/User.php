<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = [
        'role'
    ];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function getRole()
    {
        return $this->role()->firstOrFail();
    }

    public static function createGuest()
    {
        $role = Role::getByName('guest');
        $user = new self;
        $user->role()->associate($role);
        return $user;
    }

    public function isGuest()
    {
        return $this->getRole()->name === 'guest';
    }

    public function save(array $options = [])
    {
        if ($this->isGuest())
            throw new \Exception("User can`t be save, because he is guest");
        else
            return parent::save($options);
    }

    protected function processPermission(string $modelName)
    {
        try {
            $permission = $this->getRole()->getPermissionByModelName($modelName);
        } catch (\Exception $e) {
            try {
                $permission = Permission::getByModelName($modelName);
            } catch (\Exception $e) {
                $permission = Permission::generate($modelName);
            }
        }

        return $permission;
    }

    public function grantBrowseAccess(string $modelName, bool $value = true)
    {
        $permission = $this->processPermission($modelName);
        $this->getRole()->permissions()->syncWithoutDetaching([
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
        $this->getRole()->permissions()->syncWithoutDetaching([
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
        $this->getRole()->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse ?? 0,
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
        $this->getRole()->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse ?? 0,
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
        $this->getRole()->permissions()->syncWithoutDetaching([
            $permission->id => [
                'browse' => $permission->pivot->browse ?? 0,
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
        $this->getRole()->permissions()->syncWithoutDetaching([
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
        $this->getRole()->permissions()->syncWithoutDetaching([
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
}
