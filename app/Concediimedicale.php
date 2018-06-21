<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Concediimedicale extends Model
{
    public $timestamps = true;
    protected $table = 'concediimedicales';
    protected $fillable = ['pacient_id','serie', 'startdate', 'enddate','diagnostic','consultid','duration'];
    protected $guarded = ['id'];

    public function pacient()
    {
        return $this->belongsTo('App\Pacient', 'pacient_id');
    }
}
