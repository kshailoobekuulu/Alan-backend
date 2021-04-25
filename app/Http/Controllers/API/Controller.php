<?php


namespace App\Http\Controllers\API;
/**
 * @OA\Info(
 *     title="Project_Alan API documentation example",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="aldaberdiev99@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Products",
 *     description="Products list",
 * )
 * @OA\Tag(
 *     name="Actions",
 *     description="Actions list",
 * )
 * @OA\Tag(
 *     name="Categories",
 *     description="Categories list",
 * )
 * @OA\Tag(
 *     name="Orders",
 *     description="Orders list",
 * )
 * @OA\Tag(
 *     name="Banners",
 *     description="Banners list",
 * )
 *  * @OA\Tag(
 *     name="Cart",
 *     description="Cart list",
 * )
 * @OA\Server(
 *     description="Laravel Swagger API server",
 *     url="http://127.0.0.1:8000/api"
 * )
 * @OA\SecurityScheme(
 *     type="apiKey",
 *     in="header",
 *     name="X-APP-ID",
 *     securityScheme="X-APP-ID"
 * )
 */

class Controller extends \App\Http\Controllers\Controller
{

}
