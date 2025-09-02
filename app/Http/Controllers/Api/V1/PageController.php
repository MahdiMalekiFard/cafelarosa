<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Page;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdatePageRequest;
use App\Http\Requests\StorePageRequest;
use App\Http\Resources\PageResource;
use App\Actions\Page\StorePageAction;
use App\Actions\Page\DeletePageAction;
use App\Actions\Page\UpdatePageAction;
use App\Repositories\Page\PageRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class PageController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Page::class);
    }

    /**
     * @OA\Get(
     *     path="/page",
     *     operationId="getPages",
     *     tags={"Page"},
     *     summary="get pages list",
     *     description="Returns list of pages",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/PageResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(PageRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            PageResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Page::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/page/{page}",
     *     operationId="getPageByID",
     *     tags={"Page"},
     *     summary="Get page information",
     *     description="Returns page data",
     *     @OA\Parameter(name="page", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/PageResource")
     *          )
     *      )
     * )
     */
    public function show(Page $page): JsonResponse
    {
        return Response::data(
            PageDetailResource::make($page),
        );
    }

    /**
     * @OA\Post(
     *     path="/page",
     *     operationId="storePage",
     *     tags={"Page"},
     *     summary="Store new page",
     *     description="Returns new page data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePageRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StorePageRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/PageResource")
     *          )
     *      )
     * )
     */
    public function store(StorePageRequest $request): JsonResponse
    {
        $model = StorePageAction::run($request->validated());
        return Response::data(
            PageResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('page.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/page/{page}",
     *     operationId="updatePage",
     *     tags={"Page"},
     *     summary="Update existing page",
     *     description="Returns updated page data",
     *     @OA\Parameter(name="page",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePageRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdatePageRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/PageResource")
     *          )
     *      )
     * )
     */
    public function update(UpdatePageRequest $request, Page $page): JsonResponse
    {
        $data = UpdatePageAction::run($page, $request->all());
        return Response::data(
            PageResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('page.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/page/{page}",
     *      operationId="deletePage",
     *      tags={"Page"},
     *      summary="Delete existing page",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="page",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Page $page): JsonResponse
    {
        DeletePageAction::run($page);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('page.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/page/toggle/{page}",
//     *     operationId="togglePage",
//     *     tags={"Page"},
//     *     summary="Toggle Page",
//     *     description="Toggle Page",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/PageResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Page $page): JsonResponse
//    {
//        $category = TogglePageAction::run($page);
//
//        return Response::data(
//            PageResource::make($page),
//            trans('general.model_has_toggled_successfully', ['model' => trans('page.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/page/data",
//     *     operationId="getPageData",
//     *     tags={"Page"},
//     *     summary="Get Page data",
//     *     description="Returns Page data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/PageResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Page::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
