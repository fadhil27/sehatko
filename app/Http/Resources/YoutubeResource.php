<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class YoutubeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $title = (strlen($this->title) >= 35) ? substr($this->title, 0, 35) . ' ...' : $this->title;
        $link = (strlen($this->link) >= 35) ? substr($this->link, 0, 35) . ' ...' : $this->link;
        return [
            'id'    => $this->id,
            'title' => $title,
            'link'  => $link,
        ];
    }
}
