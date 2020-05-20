<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class ActorIdeal extends Model
{
    public function expediente_civils() {
        return $this->belongsToMany('LegalIS\ExpedienteCivil','actideal_expcivil','actideal_id','expcivil_id');
    }

    public static function boot()
    {
        parent::boot();

        ActorIdeal::deleting(function($actorIdeal) 
            {
                $actorIdeal->expediente_civils()->detach();
            });
    } 
}
