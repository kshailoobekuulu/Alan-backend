<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="OrderResource",
 *     description="Order resource",
 *     @OA\Xml(
 *         name="OrderResource"
 *     )
 * )
 */
class OrderResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Order
     */
    private $data;
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'addres'=>$this->address,
            'phone'=>$this->phone,
            'total_price'=>$this->total_price,
            'additional_information'=>$this->additional_information,
            'created_at'=>$this->created_at,
            'updated_at'=>$this->updated_at
        ] ;
    }
}
