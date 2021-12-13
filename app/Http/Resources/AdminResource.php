<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $username = (strlen($this->username)>=15)? substr($this->username, 0, 15). ' ...' : $this->username;
        if($this->last_login_at == null){
            return [
                'id'            => $this->id,
                'username'      => $username,
                'role'          => $this->role,
                'last_login_at' => '-'
            ];
        }
        return [
            'id'            => $this->id,
            'username'      => $username,
            'role'          => $this->role,
            'last_login_at' => Carbon::parse($this->last_login_at)->diffForHumans()
        ];
    }
}
