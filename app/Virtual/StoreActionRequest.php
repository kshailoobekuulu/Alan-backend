<?php
namespace App\Virtual;
/**
 * @OA\Schema(
 *      title="Store Project request",
 *      description="Store Project request body data",
 *      type="object",
 *      required={"price,title"}
 * )
 */
class StoreActionRequest
{
    /**
     * @OA\Property(
     *     title="price",
     *     description="Price of action for storring",
     *     example="55",
     * )
     *
     * @var int
     */
    public $price;

    /**
     * @OA\Property(
     *     title="Title",
     *     description="Title for storring",
     *     example="About action",
     * )
     *
     * @var string
     */
    public $title;
    /**
     * @OA\Property(
     *      title="product_id",
     *      description="Product's id of the new action",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $product_id;
}
