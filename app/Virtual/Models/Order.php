<?php
namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Order",
 *     description="Order model",
 *     @OA\Xml(
 *         name="Order"
 *     )
 * )
 */
class Order
{
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
}
