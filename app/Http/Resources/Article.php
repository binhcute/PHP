<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Article extends JsonResource
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
            'artice_id' => $this->artice_id,
            'user_id' => $this->user_id,
            'artice_name' => $this->name,
            'artice_img' => $this->artice_img,
            'article_description' => $this->article_description,
            'artice_keyword' => $this->artice_keyword,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'status' => $this->status,
            'view' => $this->view
        ];
    }
}
