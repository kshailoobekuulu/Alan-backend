<?php

namespace App\Http\Resources;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="CartActionResource",
 *     description="Cart action resource",
 *     @OA\Xml(
 *         name="CartActionResource"
 *     )
 * )
 */
class CartActionResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Actions",
     *     description="Actions wrapper"
     * )
     *
     * @var \App\Virtual\Models\CartAction[]
     */
    public function toArray($request)
    {
        return[
            'quantity'  =>  $this->quantity,
            'id'        =>  $this->id,
            'price'     =>  $this->price,
            'title'      =>  $this->title,
            'photo'     =>  $this->photo,
            'created_at'=>  $this->created_at,
            'updated_at'=>  $this->updated_at,
        ];
    }
}
