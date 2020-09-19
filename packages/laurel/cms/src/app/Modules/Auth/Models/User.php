<?php

namespace Laurel\CMS\Modules\Auth\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Laurel\CMS\Modules\Localization\Traits\HasTranslations;

/**
 * Class User
 * @package App\Models
 * @property string $id
 * @property string $email
 * @property string $login
 * @property string $password
 */

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasTranslations;

    public const MALE = 'male';
    public const FEMALE = 'female';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected array $translatable = [
        'name'
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

    public function ipAddresses()
    {
        return $this->belongsToMany(IpAddress::class)->withTimestamps();
    }

    public static function findUserByLogin(string $login)
    {
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
        return self::where($field, $login)->first();
    }
}
