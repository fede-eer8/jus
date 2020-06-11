<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class Decreto extends Model
{
    public function expediente_civils() {
        return $this->belongsTo('LegalIS\ExpedienteCivil', 'expcivil_id');
    }
}
