<?php

namespace App\Http\Resources;

use App\Model\Blog;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $category_name = (strlen($this->category_name)>=15)? substr($this->category_name, 0, 15). ' ...' : $this->category_name;
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
        $binding = (strlen($binding)>=15)? substr($binding, 0, 15). ' ...' : $binding;
        return [
            'id'                => $this->id,
            'category_name'     => $category_name,
            'binding'           => $binding
        ];
    }
}
