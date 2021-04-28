<?php
namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Store Order actions request. ",
 *      description="Store order actions request body data",
 *      type="object",
 *      required={"id","quantity"}
 * )
 */
class OrderActionRequest
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Id of the  'action'",
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
     *      description="Quantity of the 'action'",
     *      format="int64",
     *      example=3
     * )
     *
     * @var integer
     */
    public $quantity;
}
