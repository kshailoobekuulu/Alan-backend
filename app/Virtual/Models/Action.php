<?php
namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Action",
 *     description="Action model",
 *     @OA\Xml(
 *         name="Action"
 *     )
 * )
 */
class Action
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
     *      title="Price",
     *      description="Price of the new Action",
     *      example="60"
     * )
     *
     * @var integer
     */
    public $price;
    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the new action",
     *      example="This is new action's title"
     * )
     *
     * @var string
     */
    public $title;
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
    /**
     * @OA\Property(
     *      title="Product ID",
     *      description="Product's id of the new action",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $product_id;


    /**
     * @OA\Property(
     *     title="Product",
     *     description="Action product's user model"
     * )
     *
     * @var \App\Virtual\Models\Product
     */
    private $product;
}
