<?php


namespace Laurel\CMS\Modules\Auth\Models;


use Carbon\Carbon;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Model;

/**
 * Class PasswordReset
 * @package Laurel\CMS\Modules\Auth\Models
 * @property bool $token
 * @property bool $email
 * @property CarbonInterface $created_at
 */

class PasswordReset extends Model
{
    protected $fillable = [
        'ip_address'
    ];

    public function notIsExpired() : bool
    {
        $diffInMinutes = $this->created_at->diffInMinutes(Carbon::now());
        return $diffInMinutes <= settingsModule()->setting('admin.password.token_expires_in_minutes', 15);
    }

    public static function getByEmail(string $email)
    {
        return self::where('email', $email)->get();
    }
}
