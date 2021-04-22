<?php

/**
 * @OA\Schema(
 *     type="object",
 *     title="Category post example",
 *     description="Some simple request createad as action",
 * )
 */
class CategoryStoreRequest
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
