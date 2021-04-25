<?php
namespace App\Virtual\Models;
/**
 * @OA\Schema(
 *     title="Action",
 *     description="Action model",
 *     @OA\Xml(
 *         name="Action"
 *     )
 * )
 */
class Action
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
     *      title="Price",
     *      description="Price of the new Action",
     *      example="60"
     * )
     *
     * @var integer
     */
    public $price;
    /**
     * @OA\Property(
     *      title="Title",
     *      description="Title of the new action",
     *      example="This is new action's title"
     * )
     *
     * @var string
     */
    public $title;
    /**
     * @OA\Property(
     *      title="Photo",
     *      description="Photo of the new action",
     *      example="http://DoolatKrasavchik.png"
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

    /**
     * @OA\Property(
     *     title="Products",
     *     description="Action product's models"
     * )
     *
     * @var \App\Virtual\Models\ActionProduct[]
     */
    private $products;
}
