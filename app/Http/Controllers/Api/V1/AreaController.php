<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Area;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateAreaRequest;
use App\Http\Requests\StoreAreaRequest;
use App\Http\Resources\AreaResource;
use App\Actions\Area\StoreAreaAction;
use App\Actions\Area\DeleteAreaAction;
use App\Actions\Area\UpdateAreaAction;
use App\Repositories\Area\AreaRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class AreaController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Area::class);
    }

    /**
     * @OA\Get(
     *     path="/area",
     *     operationId="getAreas",
     *     tags={"Area"},
     *     summary="get areas list",
     *     description="Returns list of areas",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/AreaResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(AreaRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            AreaResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Area::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/area/{area}",
     *     operationId="getAreaByID",
     *     tags={"Area"},
     *     summary="Get area information",
     *     description="Returns area data",
     *     @OA\Parameter(name="area", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/AreaResource")
     *          )
     *      )
     * )
     */
    public function show(Area $area): JsonResponse
    {
        return Response::data(
            AreaDetailResource::make($area),
        );
    }

    /**
     * @OA\Post(
     *     path="/area",
     *     operationId="storeArea",
     *     tags={"Area"},
     *     summary="Store new area",
     *     description="Returns new area data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreAreaRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreAreaRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/AreaResource")
     *          )
     *      )
     * )
     */
    public function store(StoreAreaRequest $request): JsonResponse
    {
        $model = StoreAreaAction::run($request->validated());
        return Response::data(
            AreaResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('area.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/area/{area}",
     *     operationId="updateArea",
     *     tags={"Area"},
     *     summary="Update existing area",
     *     description="Returns updated area data",
     *     @OA\Parameter(name="area",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateAreaRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateAreaRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/AreaResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateAreaRequest $request, Area $area): JsonResponse
    {
        $data = UpdateAreaAction::run($area, $request->all());
        return Response::data(
            AreaResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('area.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/area/{area}",
     *      operationId="deleteArea",
     *      tags={"Area"},
     *      summary="Delete existing area",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="area",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Area $area): JsonResponse
    {
        DeleteAreaAction::run($area);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('area.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/area/toggle/{area}",
//     *     operationId="toggleArea",
//     *     tags={"Area"},
//     *     summary="Toggle Area",
//     *     description="Toggle Area",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/AreaResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Area $area): JsonResponse
//    {
//        $category = ToggleAreaAction::run($area);
//
//        return Response::data(
//            AreaResource::make($area),
//            trans('general.model_has_toggled_successfully', ['model' => trans('area.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/area/data",
//     *     operationId="getAreaData",
//     *     tags={"Area"},
//     *     summary="Get Area data",
//     *     description="Returns Area data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/AreaResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Area::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
