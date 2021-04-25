<?php
namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Cart",
 *     description="Cart model",
 *     @OA\Xml(
 *         name="CartProduct"
 *     )
 * )
 */
class CartProduct
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
     *     title="ID",
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
     *      title="Name",
     *      description="Name of the new product",
     *      example="Banana"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="Price",
     *      description="Price of the new product",
     *      example="60"
     * )
     *
     * @var integer
     */
    public $price;
    /**
     * @OA\Property(
     *      title="Photo",
     *      description="Photo of the new product",
     *      example="http://photOfDoolat.png"
     * )
     *
     * @var string
     */
    public $photo;
    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;
}
