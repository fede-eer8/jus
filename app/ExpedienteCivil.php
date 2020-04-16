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

    public function categoria() {
        return $this->belongsTo('LegalIS\Categoria', 'cat_id');
    }
    
    public function materia() {
        return $this->belongsTo('LegalIS\Materia', 'mat_id');
    }

    public static function boot()
    {
        parent::boot();

        ExpedienteCivil::deleting(function($expedienteCivil) 
            {
                $expedienteCivil->humanActors()->detach();
            });
    } 
}

