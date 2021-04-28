<?php
namespace App\Virtual;
/**
 * @OA\Schema(
 *     title="Order",
 *     description="Order model",
 *     @OA\Xml(
 *         name="Order"
 *     )
 * )
 */
class StoreOrderRequest
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
     * @var \App\Virtual\OrderProductRequest[]
     */
    private $products;
    /**
     * @OA\Property(
     *     title="Actions",
     *     description="Actions wrapper"
     * )
     *
     * @var \App\Virtual\OrderActionRequest[]
     */
    private $actions;
}
