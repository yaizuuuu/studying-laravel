<?php

namespace App\Eloquent;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getYoungOrAdultAttribute(): string
    {
        return $this->age >= 20 ? 'adult' : 'young';
    }

    /**
     * @param int $age
     */
    public function setAgeAttribute(int $age): void
    {
        $this->attributes['age'] = $age;
    }

    public function setOtherPasswordAttribute(string $password): void
    {
        $this->attributes['other_password'] = \Hash::make($password);
    }

    /**
     * @return string
     */
    public function info(): string
    {
        return sprintf(
            '%s : %s',
            $this->name,
            $this->email
        );
    }

    /**
     * @return User
     */
    public function firstYaizuuuuNameUser(): self
    {
        return $this->where('name', 'yaizuuuu')->first();
    }
}
