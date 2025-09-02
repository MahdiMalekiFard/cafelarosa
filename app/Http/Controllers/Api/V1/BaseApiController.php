<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="Laravel OpenApi Demo Documentation",
 *     description="L5 Swagger OpenApi description",
 *
 *     @OA\Contact(
 *         email="admin@admin.com"
 *     ),
 *
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 *
 * @OA\Server(
 *     url=L5_SWAGGER_CONST_HOST,
 *     description="Local Host"
 * )
 * @OA\Server(
 *     url="https://dev.metanext.biz",
 *     description="Local Host"
 * )
 *
 * @OA\Schema(
 *     schema="Meta",
 *     title="Pagination",
 *
 *     @OA\Property(property="current_page", type="integer", description="Current page number", example=1),
 *     @OA\Property(property="from", type="integer", description="First page number", example=1),
 *     @OA\Property(property="last_page", type="integer", description="Last page number", example=2),
 *     @OA\Property(property="links", type="array", description="Links of pages",
 *
 *         @OA\Items(
 *             type="object",
 *
 *             @OA\Property(property="url", type="string", description="Url of page", example="http://localhost:8000/api/v1/shift?page=1"),
 *             @OA\Property(property="label", type="string", description="Label of page", example="1"),
 *             @OA\Property(property="active", type="boolean", description="this page is active or not", example=true)
 *         ),
 *         example={
 *             {
 *                 "url" : "http://localhost:8000/api/v1/shift?page=1",
 *                 "label" : 1,
 *                 "active" : true
 *             },
 *             {
 *                 "url" : "http://localhost:8000/api/v1/shift?page=2",
 *                 "label" : 2,
 *                 "active" : false
 *             },
 *             {
 *                 "url" : "http://127.0.0.1:8000/api/v1/shift?page=2",
 *                 "label" : "Next &raquo;",
 *                 "active" : true
 *             },
 *             {
 *                 "url" : null,
 *                 "label" : "&laquo; Prev",
 *                 "active" : false
 *             },
 *         }
 *     ),
 *     @OA\Property(property="path", type="string", description="Base url path", example="http://localhost:8000/api/v1/shift"),
 *     @OA\Property(property="per_page", type="integer", description="Number of items per page", example=15),
 *     @OA\Property(property="to", type="integer", description="Last page number", example=10),
 *     @OA\Property(property="total", type="integer", description="number of records", example=50),
 * )
 *
 * @OA\Schema(
 *     schema="Pagination",
 *     title="Pagination",
 *
 *     @OA\Property(property="message", type="string", example="example message"),
 *     @OA\Property(property="data", type="array",
 *
 *         @OA\Items(
 *             anyOf={
 *
 *                 @OA\Schema(ref="#/components/schemas/CategoryResource"),
 *                 @OA\Schema(ref="#/components/schemas/BlogResource"),
 *             }
 *         )
 *     ),
 *
 *     @OA\Property(property="meta", ref="#/components/schemas/Meta")
 * ),
 *
 * @OA\Parameter(
 *     parameter="AdvancedSearch",
 *     name="filter[a_search]",
 *     in="query",
 *     description="Search in events",
 *     required=false,
 *
 *     @OA\Schema(
 *         type="array",
 *
 *         @OA\Items(
 *             type="object",
 *
 *             @OA\Property(property="column", type="string", example="title", enum={"title", "description", "date"}),
 *             @OA\Property(property="operator", type="string", example="like", enum={"like", "=", ">", "<", ">=", "<="}),
 *             @OA\Property(property="from", type="string", example="test"),
 *             @OA\Property(property="to", type="string", example="test"),
 *             @OA\Property(property="contain", type="integer", example="1", enum={0, 1}),
 *         )
 *     )
 * )
 *
 * @OA\Parameter(
 *     parameter="Filter",
 *     name="filter",
 *     in="query",
 *     description="Filter shifts",
 *     required=false,
 *
 *     @OA\Schema(
 *         type="object",
 *
 *         @OA\Property(property="search", type="string", example=""),
 *         @OA\Property(property="name", type="string", example="", ),
 *     )
 * )
 *
 * @OA\Parameter(
 *     parameter="Sort",
 *     name="sort",
 *     in="query",
 *     required=false,
 *
 *     @OA\Schema(type="array", @OA\Items(type="string"), default={"-id"}, example={"-id"}),
 *     description="Sort criteria for shifts (e.g., name, -created_at)"
 * )
 *
 * @OA\Parameter(parameter="Page", name="page", in="query", required=false, @OA\Schema(type="integer", default=1), description="page number")
 * @OA\Parameter(parameter="PageLimit", name="page_limit", in="query", required=false, @OA\Schema(type="integer", default=15), description="number of items per page")
 *
 * @OA\Response(
 *     response="400",
 *     description="Bad Request",
 *
 *     @OA\JsonContent(@OA\Property(property="error", type="string", example="Bad Request."))
 * )
 *
 * @OA\Response(
 *     response="401",
 *     description="Unauthorized",
 *
 *     @OA\JsonContent(@OA\Property(property="error", type="string", example="Unauthenticated."))
 * )
 *
 * @OA\Response(
 *     response="403",
 *     description="Forbidden",
 *
 *     @OA\JsonContent(@OA\Property(property="error", type="string", example="Forbidden."))
 * )
 *
 * @OA\Response(
 *     response="500",
 *     description="Internal Server Error",
 *
 *     @OA\JsonContent(@OA\Property(property="error", type="string", example="Internal Server Error."))
 * )
 */
class BaseApiController extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
