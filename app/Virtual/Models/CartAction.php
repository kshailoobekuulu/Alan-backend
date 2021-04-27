<?php
namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="CartAction",
 *     description="Cart action model",
 *     @OA\Xml(
 *         name="CartAction"
 *     )
 * )
 */
class CartAction
{
    /**
     * @OA\Property(
     *      title="Quantity",
     *      description="Quantity of the action",
     *      example="1"
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
     *      title="Price",
     *      description="Price of the action",
     *      example="420"
     * )
     *
     * @var integer
     */
    public $price;
    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the action",
     *      example="About action"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="Photo",
     *      description="Photo of the action",
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
