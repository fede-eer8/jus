<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class DemandadoIdeal extends Model
{
    public function expediente_civils() {
        return $this->belongsToMany('LegalIS\ExpedienteCivil','demandadoideal_expcivil','demandadoideal_id','expcivil_id');
    }

    public static function boot()
    {
        parent::boot();

        DemandadoIdeal::deleting(function($demandadoIdeal) 
            {
                $demandadoIdeal->expediente_civils()->detach();
            });
    }
}
