<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AgendaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'agenda_head'           => $this->agenda_head,
            'agenda_description'    => $this->agenda_description,
            'start_date'            => $this->start_date,
            'end_date'              => $this->end_date,
        ];
    }
}
