<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    public function expediente_civils() {
        return $this->hasMany('LegalIS\ExpedienteCivil');
    }
}
