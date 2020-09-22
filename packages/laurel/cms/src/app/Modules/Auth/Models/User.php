<?php

namespace Laurel\CMS\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
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
 * @property boolean $is_blocked
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
        'is_blocked' => 'bool'
    ];

    protected $dates = [
        'blocked_at', 'blocked_until'
    ];

    public function ipAddresses() : BelongsToMany
    {
        return $this->belongsToMany(IpAddress::class)->withTimestamps()->withPivot([ 'confirmation_code', 'is_confirmed', 'confirmation_code_sent_at' ]);
    }

    public static function findByLogin(string $login) : self
    {
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
        return self::where($field, $login)->first();
    }

    public static function findByEmail(string $email) : self
    {
        return self::where('email', $email)->first();
    }

    public static function findByIpAddress(string $ipAddress) : self
    {
        return self::whereHas('ipAddresses', function (Builder $ipAddressQuery) use ($ipAddress) {
            return $ipAddressQuery->where('ip_address', $ipAddress);
        })->first();
    }

    public function findIpAddress(string $ipAddress) : IpAddress
    {
        return $this->ipAddresses()->firstOrNew([
            'ip_address' => $ipAddress
        ]);
    }

    public function isBlocked() : bool
    {
        return $this->is_blocked;
    }
}
