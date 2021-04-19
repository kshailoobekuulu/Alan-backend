<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ActionResource extends JsonResource
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
            'id'=>$this->id,
            'price'=>$this->price,
            'title'=>$this->title,
            'created_at'=>$this->created_at,
            'products'=>ActionProductResource::collection($this->products),
            'orders'=>ActionOrderResource::collection($this->orders)
        ];
    }
}
