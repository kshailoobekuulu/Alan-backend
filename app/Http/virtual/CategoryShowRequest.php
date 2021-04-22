<?php
/**
 * @OA\Schema(
 *     type="object",
 *     title="Category get example",
 *     description="Some simple example",
 * )
 */
class CategoryShowRequest
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
     *     title="name",
     *     description="Name of the category",
     *     example="Fruits",
     * )
     *
     * @var int
     */
    public $name;

    /**
     * @OA\Property(
     *     title="slug",
     *     description="Slug for category",
     *     example="About action",
     * )
     *
     * @var string
     */
    public $slug;
    /**
     * @OA\Property(
     *     title="photo",
     *     description="Photo of category",
     *     example="https://www.google.com/search?q=fruits&sxsrf=ALeKk00am-a2RSceVhR9xhnmtlTf6hyi4A:1619097112058&tbm=isch&source=iu&ictx=1&fir=Iqrn9zwUMx_LVM%252CV1GXApsZb-s1oM%252C_&vet=1&usg=AI4_-kQn1ZS8qcz8wpqJ5SAbYI3mivconA&sa=X&ved=2ahUKEwjs-OHh9pHwAhXSpIsKHfgoB5kQ9QF6BAgSEAE#imgrc=Iqrn9zwUMx_LVM",
     * )
     *
     * @var string
     */
    public $photo;
    /**
     * @OA\Property(
     *     title="Category_icon",
     *     description="Category icon",
     *     example="https://www.google.com/search?q=fruits&sxsrf=ALeKk00am-a2RSceVhR9xhnmtlTf6hyi4A:1619097112058&tbm=isch&source=iu&ictx=1&fir=Iqrn9zwUMx_LVM%252CV1GXApsZb-s1oM%252C_&vet=1&usg=AI4_-kQn1ZS8qcz8wpqJ5SAbYI3mivconA&sa=X&ved=2ahUKEwjs-OHh9pHwAhXSpIsKHfgoB5kQ9QF6BAgSEAE#imgrc=Iqrn9zwUMx_LVM",
     * )
     *
     * @var string
     */
    public $category_icon;
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
