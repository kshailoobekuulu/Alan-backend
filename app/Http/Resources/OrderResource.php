<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="OrderRResource",
 *     description="Order resource",
 *     @OA\Xml(
 *         name="OrderRResource"
 *     )
 * )
 */
class OrderResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Orders",
     *     description="Orders wrapper"
     * )
     *
     * @var \App\Virtual\Models\Order[]
     */
    private $data;
    public function toArray($request)
    {
        return [
            'quantity' => $this->id
        ] ;
    }
}
