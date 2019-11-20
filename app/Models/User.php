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

    public function grantBrowseAccess(string $modelName, bool $value = true)
    {
        $this->getRole()->grantBrowseAccess($modelName, $value);
        return $this;
    }

    public function grantReadAccess(string $modelName, bool $value = true)
    {
        $this->getRole()->grantReadAccess($modelName, $value);
        return $this;
    }

    public function grantAddAccess(string $modelName, bool $value = true)
    {
        $this->getRole()->grantAddAccess($modelName, $value);
        return $this;
    }

    public function grantEditAccess(string $modelName, bool $value = true)
    {
        $this->getRole()->grantEditAccess($modelName, $value);
        return $this;
    }

    public function grantDeleteAccess(string $modelName, bool $value = true)
    {
        $this->getRole()->grantDeleteAccess($modelName, $value);
        return $this;
    }

    public function grantAccess(string $modelName)
    {
        $this->getRole()->grantAccess($modelName);
        return $this;
    }

    public function disableAccess(string $modelName)
    {
        $this->getRole()->disableAccess($modelName);
        return $this;
    }
}
