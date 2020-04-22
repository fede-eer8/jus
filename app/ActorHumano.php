<?php

namespace LegalIS;
use LegalIS\ActorHumano;

use Illuminate\Database\Eloquent\Model;

class ActorHumano extends Model
{
    protected $fillable = [
        'nombre', 'apellido', 'seudonimo', 'edad' 
    ];
    
    public function expediente_civils() {
        return $this->belongsToMany('LegalIS\ExpedienteCivil','acthumano_expcivil','acthumano_id','expcivil_id');
    }

    public function representanteLegal() {
        return $this->belongsTo('LegalIS\RepresentanteLegal', 'replegal_id');
    }

    public static function boot()
    {
        parent::boot();

        ActorHumano::deleting(function($actorHumano) 
            {
                $actorHumano->expediente_civils()->detach();
            });
    } 
}
