<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategorySelectedResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $binding       = '';
        // $categories    = Blog::where('category_id',$this->id)->get();
        $count = count($this->blogs)-1;
        if($count >= 0){
            foreach($this->blogs as $key => $category){
                if($key == $count){
                    $binding .= $category->title;
                }else{
                    $binding .= $category->title . ', ';
                }
            }
        }else{
            $binding .= 'There is no!';
        }
        return [
            'id'                => $this->id,
            'category_name'     => $this->category_name,
            'binding'           => $binding
        ];
    }
}
