<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InboxResource extends JsonResource
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
        $email = (strlen($this->email)>=15)? substr($this->email, 0, 15). ' ...' : $this->email;
        $phone_number = (strlen($this->phone_number)>=15)? substr($this->phone_number, 0, 15). ' ...' : $this->phone_number;
        $message_content = (strlen($this->message_content)>=15)? substr($this->message_content, 0, 15). ' ...' : $this->message_content;
        return [
            "id"                => $this->id,
            "name"              => $name,
            "email"             => $email,
            "phone_number"      => $phone_number,
            "message_content"   => $message_content
        ];
    }
}
