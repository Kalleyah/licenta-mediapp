<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programari extends Model
{
    public $timestamps = false;
    protected $table = 'programaris';
     /**
     * Indicates primary key of the table
     *
     * @var bool
     */
    public $primaryKey = 'id';
    protected $fillable = ['pacient_id', 'startdate', 'starthour','duration'];
    protected $guarded = ['id'];

    public function pacient()
    {
        return $this->belongsTo('App\Pacient', 'pacient_id');
    }
}
