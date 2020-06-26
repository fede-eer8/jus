<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class TipoDocumento extends Model
{
    public function documento(){
        return $this->hasOne('LegalIS\Documento');
    }
}
