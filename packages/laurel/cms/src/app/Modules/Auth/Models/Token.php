<?php


namespace Laurel\CMS\Modules\Auth\Models;

use \Laravel\Passport\Token as PassportToken;

class Token extends PassportToken
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expires_at', 'lock_at',
    ];

    public function save(array $options = [])
    {
        $this->addLockAtAttribute();
        return parent::save($options);
    }

    public function saveOrFail(array $options = [])
    {
        return parent::saveOrFail($options);
    }

    protected function addLockAtAttribute()
    {
        $this->attributes['lock_at'] = now()->addMinutes(
            settingsModule()->setting('admin.lock_after_minutes', null)
        );
    }
}
