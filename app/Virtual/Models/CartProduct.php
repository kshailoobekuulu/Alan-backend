<?php
namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="CartProduct",
 *     description="Cart product model",
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
     *      description="Quantity of the product",
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
     *      description="Name of the product",
     *      example="Banana"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="Price",
     *      description="Price of the product",
     *      example="60"
     * )
     *
     * @var integer
     */
    public $price;
    /**
     * @OA\Property(
     *      title="Photo",
     *      description="Photo of the product",
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
