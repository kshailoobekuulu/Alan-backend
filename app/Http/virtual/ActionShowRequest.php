<?php
/**
 * @OA\Schema(
 *     type="object",
 *     title="Action get example",
 *     description="Some simple action example",
 * )
 */
class ActionShowRequest
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="Unique ID",
     *     example="1",
     * )
     *
     * @var int
     */
    public $id;

    /**
     * @OA\Property(
     *     title="Price",
     *     description="Value of price for storring",
     *     example="60",
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

}
