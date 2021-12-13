<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AgendaHomeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $start_date = Carbon::parse($this->start_date)->format('m/d/Y');
        $end_date = Carbon::parse($this->end_date)->format('m/d/Y');
        return [
            'id'            => $this->id,
            'name'          => $this->agenda_head,
            'description'   => $this->agenda_description,
            'date'          => [$start_date, $end_date],
            'type'          => 'event',
            'color'         => '#003597'
        ];
    }
}
