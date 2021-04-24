<?php
namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Banner",
 *     description="Banner model",
 *     @OA\Xml(
 *         name="Banner"
 *     )
 * )
 */
class Banner
{
    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private $id;
    /**
     * @OA\Property(
     *      title="Description",
     *      description="Description of the new banner",
     *      example="This is new banner's description"
     * )
     *
     * @var string
     */
    public $description;

    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the new banner",
     *      example="This is new banner's title"
     * )
     *
     * @var string
     */
    public $title;
    /**
     * @OA\Property(
     *      title="Photo",
     *      description="Photo of the new banner",
     *      example="This is new banner's photo"
     * )
     *
     * @var string
     */
    public $photo;
    /**
     * @OA\Property(
     *     title="Created at",
     *     description="Created at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $created_at;

    /**
     * @OA\Property(
     *     title="Updated at",
     *     description="Updated at",
     *     example="2020-01-27 17:50:45",
     *     format="datetime",
     *     type="string"
     * )
     *
     * @var \DateTime
     */
    private $updated_at;

}
