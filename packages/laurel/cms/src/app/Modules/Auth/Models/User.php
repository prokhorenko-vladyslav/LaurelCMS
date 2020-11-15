<?php

namespace Laurel\CMS\Modules\Auth\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Translatable\HasTranslations;

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
        'first_name', 'last_name', 'second_name', 'email', 'password',
    ];

    protected array $translatable = [
        'first_name', 'last_name', 'second_name'
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

    protected $appends = [
        'full_name'
    ];

    public function getFullNameAttribute()
    {
        return "{$this->last_name} {$this->first_name} {$this->second_name}";
    }

    public function routeNotificationForSlack($notification)
    {
        return config('services.slack.web_hook');
    }

    /**
     * The channels the user receives notification broadcasts on.
     *
     * @return string
     */
    public function receivesBroadcastNotificationsOn()
    {
        return 'users.'.$this->id;
    }

    public function ipAddresses() : BelongsToMany
    {
        return $this->belongsToMany(IpAddress::class)->withTimestamps()->withPivot([ 'confirmation_code', 'is_confirmed', 'confirmation_code_sent_at' ]);
    }

    public static function findByLogin(string $login, bool $throwException = false) : ?self
    {
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'login';
        $query = self::where($field, $login);
        return $throwException ? $query->firstorFail() : $query->first();
    }

    public static function findByEmail(string $email, bool $throwException = false) : ?self
    {
        $query = self::where('email', $email);
        return $throwException ? $query->firstOrFail() : $query->first();
    }

    public static function findByIpAddress(string $ipAddress, bool $throwException = false) : ?self
    {
        $query = self::whereHas('ipAddresses', function (Builder $ipAddressQuery) use ($ipAddress) {
            return $ipAddressQuery->where('ip_address', $ipAddress);
        });

        return $throwException ? $query->firstOrFail() : $query->first();
    }

    public function findIpAddressOrNew(string $ipAddress) : IpAddress
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
