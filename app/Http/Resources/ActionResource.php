<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="ActionResource",
 *     description="Action resource",
 *     @OA\Xml(
 *         name="ActionResource"
 *     )
 * )
 */
class ActionResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Action[]
     */
    private $data;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'title' => $this->title,
            'photo' => $this->photo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'products' => ActionProductResource::collection($this->products),
        ];
    }
}
