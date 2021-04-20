<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'addres'=>$this->address,
            'phone'=>$this->phone,
            'total_price'=>$this->total_price,
            'additional_information'=>$this->additional_information,
            'created_at'=>$this->created_at
        ] ;
    }
}
