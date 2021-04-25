<?php
namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store Cart request",
 *      description="Store Cart request body data",
 *      type="object",
 *      required={"id"}
 * )
 */
class StoreCartRequest
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Id of the product",
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
     *      description="Quantity of the product",
     *      format="int64",
     *      example=3
     * )
     *
     * @var integer
     */
    public $quantity;

}
