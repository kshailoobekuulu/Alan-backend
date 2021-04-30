<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @OA\Schema(
 *     title="BannerResource",
 *     description="Banner resource",
 *     @OA\Xml(
 *         name="BannerResource"
 *     )
 * )
 */
class BannerResource extends JsonResource
{
    /**
     * @OA\Property(
     *     title="Data",
     *     description="Data wrapper"
     * )
     *
     * @var \App\Virtual\Models\Banner[]
     */
    private $data;
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'title' => $this->title,
            'photo' => $this->photo,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
