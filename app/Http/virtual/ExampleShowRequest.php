<?php
/**
 * @OA\Schema(
 *     type="object",
 *     title="Example showing request",
 *     description="Some simple request createa as example",
 * )
 */
class ExampleShowRequest
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
