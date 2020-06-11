<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class ExpedienteCivil extends Model
{
    public function getRouteKeyName()
    {
        return 'slug';
    }
    
    public function humanActors() {
        return $this->belongsToMany('LegalIS\ActorHumano','acthumano_expcivil', 'expcivil_id', 'acthumano_id');   
    }

    public function idealActors() {
        return $this->belongsToMany('LegalIS\ActorIdeal','actideal_expcivil', 'expcivil_id', 'actideal_id');
    }

    public function humanDefendant() {
        return $this->belongsToMany('LegalIS\DemandadoHumano','demandadohumano_expcivil', 'expcivil_id', 'demandadohumano_id');   
    }

    public function idealDefendant() {
        return $this->belongsToMany('LegalIS\DemandadoIdeal','demandadoideal_expcivil', 'expcivil_id', 'demandadoideal_id');
    }

    public function categoria() {
        return $this->belongsTo('LegalIS\Categoria', 'cat_id');
    }
    
    public function materia() {
        return $this->belongsTo('LegalIS\Materia', 'mat_id');
    }

    public function decreto() {
        return $this->hasMany('LegalIS\Decreto','expcivil_id');
    }

    public static function boot()
    {
        parent::boot();

        ExpedienteCivil::deleting(function($expedienteCivil) 
            {
                $expedienteCivil->humanActors()->detach();
                $expedienteCivil->idealActors()->detach();
                $expedienteCivil->humanDefendant()->detach();
                $expedienteCivil->idealDefendant()->detach();
            });
    } 

}

