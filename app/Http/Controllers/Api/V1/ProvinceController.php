<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Province;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateProvinceRequest;
use App\Http\Requests\StoreProvinceRequest;
use App\Http\Resources\ProvinceResource;
use App\Actions\Province\StoreProvinceAction;
use App\Actions\Province\DeleteProvinceAction;
use App\Actions\Province\UpdateProvinceAction;
use App\Repositories\Province\ProvinceRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ProvinceController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Province::class);
    }

    /**
     * @OA\Get(
     *     path="/province",
     *     operationId="getProvinces",
     *     tags={"Province"},
     *     summary="get provinces list",
     *     description="Returns list of provinces",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/ProvinceResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(ProvinceRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ProvinceResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Province::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/province/{province}",
     *     operationId="getProvinceByID",
     *     tags={"Province"},
     *     summary="Get province information",
     *     description="Returns province data",
     *     @OA\Parameter(name="province", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ProvinceResource")
     *          )
     *      )
     * )
     */
    public function show(Province $province): JsonResponse
    {
        return Response::data(
            ProvinceDetailResource::make($province),
        );
    }

    /**
     * @OA\Post(
     *     path="/province",
     *     operationId="storeProvince",
     *     tags={"Province"},
     *     summary="Store new province",
     *     description="Returns new province data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreProvinceRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreProvinceRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ProvinceResource")
     *          )
     *      )
     * )
     */
    public function store(StoreProvinceRequest $request): JsonResponse
    {
        $model = StoreProvinceAction::run($request->validated());
        return Response::data(
            ProvinceResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('province.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/province/{province}",
     *     operationId="updateProvince",
     *     tags={"Province"},
     *     summary="Update existing province",
     *     description="Returns updated province data",
     *     @OA\Parameter(name="province",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateProvinceRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateProvinceRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ProvinceResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateProvinceRequest $request, Province $province): JsonResponse
    {
        $data = UpdateProvinceAction::run($province, $request->all());
        return Response::data(
            ProvinceResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('province.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/province/{province}",
     *      operationId="deleteProvince",
     *      tags={"Province"},
     *      summary="Delete existing province",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="province",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Province $province): JsonResponse
    {
        DeleteProvinceAction::run($province);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('province.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/province/toggle/{province}",
//     *     operationId="toggleProvince",
//     *     tags={"Province"},
//     *     summary="Toggle Province",
//     *     description="Toggle Province",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ProvinceResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Province $province): JsonResponse
//    {
//        $category = ToggleProvinceAction::run($province);
//
//        return Response::data(
//            ProvinceResource::make($province),
//            trans('general.model_has_toggled_successfully', ['model' => trans('province.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/province/data",
//     *     operationId="getProvinceData",
//     *     tags={"Province"},
//     *     summary="Get Province data",
//     *     description="Returns Province data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ProvinceResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Province::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
