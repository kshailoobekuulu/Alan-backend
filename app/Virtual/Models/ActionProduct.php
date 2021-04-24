<?php
namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Product",
 *     description="Product model",
 *     @OA\Xml(
 *         name="Product"
 *     )
 * )
 */
class ActionProduct
{
    /**
     * @OA\Property(
     *      title="Quantity",
     *      description="Quantity of the new product",
     *      example="3"
     * )
     *
     * @var integer
     */
    public $quantity;
    /**
     * @OA\Property(
     *      title="Name",
     *      description="Name of the new product",
     *      example="Banana"
     * )
     *
     * @var string
     */
    public $name;
}
