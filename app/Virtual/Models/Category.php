<?php


namespace App\Virtual\Models;

/**
 * @OA\Schema(
 *     title="Category",
 *     description="Category model",
 *     @OA\Xml(
 *         name="Category"
 *     )
 * )
 */
class Category
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
     *      title="Name",
     *      description="Name of the new category",
     *      example="Fruits"
     * )
     *
     * @var string
     */
    public $name;
    /**
     * @OA\Property(
     *      title="Slug",
     *      description="Slug of the category",
     *      example="This is new categories slug"
     * )
     *
     * @var string
     */
    public $slug;
    /**
     * @OA\Property(
     *      title="Photo",
     *      description="Photo of the new category",
     *      example="http://DoolatKrasavchik.png"
     * )
     *
     * @var string
     */
    public $photo;
    /**
     * @OA\Property(
     *      title="Category_Icon",
     *      description="Icon of the new category",
     *      example="http://DoolatKrasavchik.png"
     * )
     *
     * @var string
     */
    public $category_icon;
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
