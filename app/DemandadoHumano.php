<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class DemandadoHumano extends Model
{
    public function expediente_civils() {
        return $this->belongsToMany('LegalIS\ExpedienteCivil','demandadohumano_expcivil','demandadohumano_id','expcivil_id');
    }

    public static function boot()
    {
        parent::boot();

        DemandadoHumano::deleting(function($demandadoHumano) 
            {
                $demandadoHumano->expediente_civils()->detach();
            });
    }
}
