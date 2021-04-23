<?php
/**
 * @OA\Schema(
 *     type="object",
 *     title="Photo get example",
 *     description="Some simple example",
 * )
 */
class PhotoShowRequest
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
     *     title="url",
     *     description="Url of the Photo",
     *     example="Link of photo",
     * )
     *
     * @var string
     */
    public $url;


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
