<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UKBA_Status extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'ukba_status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    public function student()
    {
		return $this->hasMany('App\Student');
	}
}