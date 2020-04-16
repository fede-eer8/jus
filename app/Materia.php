<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    public function expediente_civils() {
        return $this->hasMany('LegalIS\ExpedienteCivil');
    }
}

