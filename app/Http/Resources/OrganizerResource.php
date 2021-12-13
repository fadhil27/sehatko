<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrganizerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $name = (strlen($this->name)>=15)? substr($this->name, 0, 15). ' ...' : $this->name;
        $position = (strlen($this->position)>=15)? substr($this->position, 0, 15). ' ...' : $this->position;
        $instagram = (strlen($this->instagram)>=15)? substr($this->instagram, 0, 15). ' ...' : $this->instagram;
        $email = (strlen($this->email)>=15)? substr($this->email, 0, 15). ' ...' : $this->email;
        return [
            'id'            => $this->id,
            'name'          => $name,
            'position'      => $position,
            'instagram'     => $instagram,
            'email'         => $email,
        ];
    }
}
