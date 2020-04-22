<?php

namespace LegalIS\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActorHumano extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido' => $this->apellido,
            'seudonimo' => $this->seudonimo,
            'edad' => $this->edad,
            'replegal_id' => $this->replegal_id,
            // 'created_at' => $this->created_at,
            // 'updated_at' => $this->updated_at,
        ];
    }
}
