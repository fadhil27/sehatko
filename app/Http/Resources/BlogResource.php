<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $content = (strlen($this->content)>=15)? substr($this->content, 0, 15). ' ...' : $this->content;
        return [
            'id'            => $this->id,
            'writer'        => $this->writer,
            'title'         => $this->title,
            'content'       => $content
        ];
    }
}
