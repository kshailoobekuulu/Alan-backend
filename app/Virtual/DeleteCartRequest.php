<?php
namespace App\Virtual;

/**
 * @OA\Schema(
 *      title="Delete Cart request",
 *      description="Delete Cart request body data",
 *      type="object",
 *      required={"id"}
 * )
 */
class DeleteCartRequest
{
    /**
     * @OA\Property(
     *      title="id",
     *      description="Id",
     *      format="int64",
     *      example=1
     * )
     *
     * @var integer
     */
    public $id;
    /**
     * @OA\Property(
     *      title="type",
     *      description="Type",
     *      format="string",
     *      example="action"
     * )
     *
     * @var integer
     */
    public $type;
}
