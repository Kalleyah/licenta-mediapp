<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pacient extends Model
{
    public $timestamps = true;
    protected $table = 'pacients';
     /**
     * Indicates primary key of the table
     *
     * @var bool
     */
    public $primaryKey = 'id';
    protected $fillable = ['firstname', 'lastname', 'birthdate','cnp','address','phone','alergii','note'];
    protected $guarded = ['id'];

    public function reservations()
    {
        return $this->hasMany('App\Programari');
    }

    public function consults()
    {
        return $this->hasMany('App\Consults');
    }

    public function concedii()
    {
        return $this->hasMany('App\Concediimedicale');
    }


     // this is a recommended way to declare event handlers
     protected static function boot() {
        parent::boot();

        static::deleting(function($pacient) { // before delete() method call this
             $pacient->reservations()->delete();
             $pacient->consults()->delete();
             $pacient->concedii()->delete();
             // do the rest of the cleanup...
        });
    }

}
