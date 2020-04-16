<?php

namespace LegalIS;

use Illuminate\Database\Eloquent\Model;

class RepresentanteLegal extends Model
{
    public function humanActors() {
        return $this->hasMany('LegalIS\ActorHumano');
    }
}
