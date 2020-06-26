<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    public function expediente_civils() {
        return $this->belongsTo('LegalIS\ExpedienteCivil', 'expcivil_id');
    }

    public function tipo_documento(){
        return $this->belongsTo('LegalIS\TipoDocumento', 'tipodoc_id');
    }
}
