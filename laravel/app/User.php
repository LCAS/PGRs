<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
    'title',
    'first_name',
    'middle_name',
    'last_name',
    'personal_email',
    'email',
    'personal_phone',
    'password',
    'image',
    'account_type',
    'locked'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function student()
    {
        return $this->hasOne('App\Student');
    }

    public function staff()
    {
        return $this->hasOne('App\Staff');
    }

    public function getFullNameAttribute()
    {
        return trim(implode(' ', array($this->attributes['title'], $this->attributes['first_name'], $this->attributes['last_name'])), ' ');
    }

    public function getCompleteNameAttribute()
    {
        return trim(implode(' ', array($this->attributes['title'], $this->attributes['first_name'], $this->attributes['middle_name'], $this->attributes['last_name'])), ' ');
    }
}
