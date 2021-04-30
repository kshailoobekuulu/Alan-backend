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
            'id' => $this->id,
            'address' => $this->address,
            'phone' => $this->phone,
            'total_price' => $this->total_price,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'products' => OrderProductResource::collection($this->products),
            'actions' => OrderActionResource::collection($this->actions),
        ] ;
    }
}
