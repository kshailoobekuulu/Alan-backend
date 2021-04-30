<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="CategoryResource",
 *     description="Category resource",
 *     @OA\Xml(
 *         name="CategoryResource"
 *     )
 * )
 */
class CategoryResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Category[]
     */
    private $data;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
            'photo' => $this->photo,
            'category_icon' => $this->category_icon,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
