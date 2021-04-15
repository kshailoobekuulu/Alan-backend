<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Example storring request",
 *     description="Some simple request createa as action",
 * )
 */
class ExampleStoreRequest
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
}
