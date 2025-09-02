<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Locality;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateLocalityRequest;
use App\Http\Requests\StoreLocalityRequest;
use App\Http\Resources\LocalityResource;
use App\Actions\Locality\StoreLocalityAction;
use App\Actions\Locality\DeleteLocalityAction;
use App\Actions\Locality\UpdateLocalityAction;
use App\Repositories\Locality\LocalityRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class LocalityController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Locality::class);
    }

    /**
     * @OA\Get(
     *     path="/locality",
     *     operationId="getLocalitys",
     *     tags={"Locality"},
     *     summary="get localitys list",
     *     description="Returns list of localitys",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/LocalityResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(LocalityRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            LocalityResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Locality::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/locality/{locality}",
     *     operationId="getLocalityByID",
     *     tags={"Locality"},
     *     summary="Get locality information",
     *     description="Returns locality data",
     *     @OA\Parameter(name="locality", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/LocalityResource")
     *          )
     *      )
     * )
     */
    public function show(Locality $locality): JsonResponse
    {
        return Response::data(
            LocalityDetailResource::make($locality),
        );
    }

    /**
     * @OA\Post(
     *     path="/locality",
     *     operationId="storeLocality",
     *     tags={"Locality"},
     *     summary="Store new locality",
     *     description="Returns new locality data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreLocalityRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreLocalityRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/LocalityResource")
     *          )
     *      )
     * )
     */
    public function store(StoreLocalityRequest $request): JsonResponse
    {
        $model = StoreLocalityAction::run($request->validated());
        return Response::data(
            LocalityResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('locality.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/locality/{locality}",
     *     operationId="updateLocality",
     *     tags={"Locality"},
     *     summary="Update existing locality",
     *     description="Returns updated locality data",
     *     @OA\Parameter(name="locality",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateLocalityRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateLocalityRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/LocalityResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateLocalityRequest $request, Locality $locality): JsonResponse
    {
        $data = UpdateLocalityAction::run($locality, $request->all());
        return Response::data(
            LocalityResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('locality.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/locality/{locality}",
     *      operationId="deleteLocality",
     *      tags={"Locality"},
     *      summary="Delete existing locality",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="locality",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Locality $locality): JsonResponse
    {
        DeleteLocalityAction::run($locality);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('locality.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/locality/toggle/{locality}",
//     *     operationId="toggleLocality",
//     *     tags={"Locality"},
//     *     summary="Toggle Locality",
//     *     description="Toggle Locality",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/LocalityResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Locality $locality): JsonResponse
//    {
//        $category = ToggleLocalityAction::run($locality);
//
//        return Response::data(
//            LocalityResource::make($locality),
//            trans('general.model_has_toggled_successfully', ['model' => trans('locality.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/locality/data",
//     *     operationId="getLocalityData",
//     *     tags={"Locality"},
//     *     summary="Get Locality data",
//     *     description="Returns Locality data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/LocalityResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Locality::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
