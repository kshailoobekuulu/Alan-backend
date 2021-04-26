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
     *     title="total_price",
     *     description="Total price",
     *     format="int64",
     *     example=480
     * )
     *
     * @var integer
     */
    private $total_price;
}
