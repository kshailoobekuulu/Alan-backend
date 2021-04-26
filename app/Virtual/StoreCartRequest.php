<?php
namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store Cart request. ",
 *      description="Store Cart request body data",
 *      type="object",
 *      required={"id","quantity","type"}
 * )
 */
class StoreCartRequest
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Id of the 'product' or 'action'",
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
     *      description="Quantity of the 'product' or 'action'",
     *      format="int64",
     *      example=3
     * )
     *
     * @var integer
     */
    public $quantity;
    /**
     * @OA\Property(
     *      title="Type",
     *      description="Type of request 'product' or 'action'",
     *      format="string",
     *      example="action"
     * )
     *
     * @var string
     */
    public $type;

}
