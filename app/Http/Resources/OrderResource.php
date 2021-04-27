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
     *     title="id",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;
    /**
     * @OA\Property(
     *     title="address",
     *     description="address",
     *     format="string",
     *     example="Ahunbaeva,Mira"
     * )
     *
     * @var string
     */
    private $address;
    /**
     * @OA\Property(
     *     title="phone",
     *     description="Phone number",
     *     format="string",
     *     example="0777152350"
     * )
     *
     * @var string
     */
    private $phone;
    /**
     * @OA\Property(
     *     title="status",
     *     description="Status",
     *     format="string",
     *     example="delivered"
     * )
     *
     * @var string
     */
    private $status;
    /**
     * @OA\Property(
     *     title="Info",
     *     description="Additional information",
     *     format="string",
     *     example="additional information"
     * )
     *
     * @var string
     */
    private $additonal_information;
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
    /**
     * @OA\Property(
     *     title="total_price",
     *     description="Total price",
     *     format="int64",
     *     example=600
     * )
     *
     * @var integer
     */
    private $total_price;
    public function toArray($request)
    {
        return [
            'quantity' => $this->id
        ] ;
    }
}
