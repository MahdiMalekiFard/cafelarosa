<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\City;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCityRequest;
use App\Http\Requests\StoreCityRequest;
use App\Http\Resources\CityResource;
use App\Actions\City\StoreCityAction;
use App\Actions\City\DeleteCityAction;
use App\Actions\City\UpdateCityAction;
use App\Repositories\City\CityRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CityController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(City::class);
    }

    /**
     * @OA\Get(
     *     path="/city",
     *     operationId="getCitys",
     *     tags={"City"},
     *     summary="get citys list",
     *     description="Returns list of citys",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/CityResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(CityRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            CityResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(City::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/city/{city}",
     *     operationId="getCityByID",
     *     tags={"City"},
     *     summary="Get city information",
     *     description="Returns city data",
     *     @OA\Parameter(name="city", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CityResource")
     *          )
     *      )
     * )
     */
    public function show(City $city): JsonResponse
    {
        return Response::data(
            CityDetailResource::make($city),
        );
    }

    /**
     * @OA\Post(
     *     path="/city",
     *     operationId="storeCity",
     *     tags={"City"},
     *     summary="Store new city",
     *     description="Returns new city data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCityRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreCityRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CityResource")
     *          )
     *      )
     * )
     */
    public function store(StoreCityRequest $request): JsonResponse
    {
        $model = StoreCityAction::run($request->validated());
        return Response::data(
            CityResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('city.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/city/{city}",
     *     operationId="updateCity",
     *     tags={"City"},
     *     summary="Update existing city",
     *     description="Returns updated city data",
     *     @OA\Parameter(name="city",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCityRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateCityRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CityResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateCityRequest $request, City $city): JsonResponse
    {
        $data = UpdateCityAction::run($city, $request->all());
        return Response::data(
            CityResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('city.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/city/{city}",
     *      operationId="deleteCity",
     *      tags={"City"},
     *      summary="Delete existing city",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="city",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(City $city): JsonResponse
    {
        DeleteCityAction::run($city);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('city.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/city/toggle/{city}",
//     *     operationId="toggleCity",
//     *     tags={"City"},
//     *     summary="Toggle City",
//     *     description="Toggle City",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/CityResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(City $city): JsonResponse
//    {
//        $category = ToggleCityAction::run($city);
//
//        return Response::data(
//            CityResource::make($city),
//            trans('general.model_has_toggled_successfully', ['model' => trans('city.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/city/data",
//     *     operationId="getCityData",
//     *     tags={"City"},
//     *     summary="Get City data",
//     *     description="Returns City data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/CityResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', City::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
