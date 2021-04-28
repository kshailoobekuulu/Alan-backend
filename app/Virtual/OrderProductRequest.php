<?php
namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store order pruduct request. ",
 *      description="Store order product request body data",
 *      type="object",
 *      required={"id","quantity"}
 * )
 */
class OrderProductRequest
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Id of the 'product'",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $id;
    /**
     * @OA\Property(
     *      title="quantity",
     *      description="Quantity of the 'product'",
     *      format="int64",
     *      example=3
     * )
     *
     * @var integer
     */
    public $quantity;
}
