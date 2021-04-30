<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="CartResource",
 *     description="Cart resource",
 *     @OA\Xml(
 *         name="CartResource"
 *     )
 * )
 */
class CartResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Products",
     *     description="Products wrapper"
     * )
     *
     * @var \App\Virtual\Models\CartProduct[]
     */
    private $products;
    /**
     * @OA\Property(
     *     title="Actions",
     *     description="Actions wrapper"
     * )
     *
     * @var \App\Virtual\Models\CartAction[]
     */
    private $actions;
    public function toArray($request)
    {
        return[
            'quantity' => $this->quantity,
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'photo' => $this->photo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
