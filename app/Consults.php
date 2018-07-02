<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consults extends Model
{
    public $timestamps = true;
    protected $table = 'consults';
    protected $fillable = ['pacient_id','medic','simpthoms', 'diagnostics', 'codboala','threatment','consultdate','medicalbreak'];
    protected $guarded = ['id'];

    public function pacient()
    {
        return $this->belongsTo('App\Pacient', 'pacient_id');
    }

    public function medic()
    {
        return $this->HasOne('App\User', 'medic');
    }


}
