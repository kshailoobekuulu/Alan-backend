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
     *     title="Products",
     *     description="Products wrapper"
     * )
     *
     * @var \App\Virtual\Models\Product[]
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
    /**
     * @OA\Property(
     *     title="total_price",
     *     description="Total price",
     *     format="int64",
     *     example=480
     * )
     *
     * @var integer
     */
    private $total_price;
    public function toArray($request)
    {
        return [
            'quantity' => $this->quantity
        ] ;
    }
}
