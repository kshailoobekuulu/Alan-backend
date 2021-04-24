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
     *      title="Address",
     *      description="Address of the new order",
     *      example="This is new order's address"
     * )
     *
     * @var string
     */
    public $address;
    /**
     * @OA\Property(
     *      title="Phone",
     *      description="Phone number of the new order",
     *      example="This is new order's phone number"
     * )
     *
     * @var string
     */
    public $phone;
    /**
     * @OA\Property(
     *      title="Total Price",
     *      description="Total price of the Order",
     *      example="360"
     * )
     *
     * @var integer
     */
    public $total_price;
    /**
     * @OA\Property(
     *      title="Additional Information",
     *      description="Additional information of the order",
     *      example="additional information"
     * )
     *
     * @var string
     */
    public $additional_information;
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
