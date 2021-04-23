<?php
/**
 * @OA\Schema(
 *     type="object",
 *     title="Banner get example",
 *     description="Some simple example",
 * )
 */
class BannerShowRequest
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
     *     title="description",
     *     description="Description of the banner",
     *     example="Description of banner",
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *     title="title",
     *     description="Title of banner",
     *     example="About banner",
     * )
     *
     * @var string
     */
    public $title;

    /**
     * @OA\Property(
     *     title="Created_at",
     *     description="Created time",
     *     example="2021-04-22T12:11:09.000000Z",
     * )
     *
     * @var string
     */
    public $created_at;

    /**
     * @OA\Property(
     *     title="Updated_at",
     *     description="Updated time",
     *     example="2021-04-22T12:11:09.000000Z",
     * )
     *
     * @var string
     */
    public $updated_at;

}
