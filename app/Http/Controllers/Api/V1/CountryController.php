<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Country;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCountryRequest;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Resources\CountryResource;
use App\Actions\Country\StoreCountryAction;
use App\Actions\Country\DeleteCountryAction;
use App\Actions\Country\UpdateCountryAction;
use App\Repositories\Country\CountryRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CountryController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Country::class);
    }

    /**
     * @OA\Get(
     *     path="/country",
     *     operationId="getCountrys",
     *     tags={"Country"},
     *     summary="get countrys list",
     *     description="Returns list of countrys",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/CountryResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(CountryRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            CountryResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Country::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/country/{country}",
     *     operationId="getCountryByID",
     *     tags={"Country"},
     *     summary="Get country information",
     *     description="Returns country data",
     *     @OA\Parameter(name="country", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CountryResource")
     *          )
     *      )
     * )
     */
    public function show(Country $country): JsonResponse
    {
        return Response::data(
            CountryDetailResource::make($country),
        );
    }

    /**
     * @OA\Post(
     *     path="/country",
     *     operationId="storeCountry",
     *     tags={"Country"},
     *     summary="Store new country",
     *     description="Returns new country data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCountryRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreCountryRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CountryResource")
     *          )
     *      )
     * )
     */
    public function store(StoreCountryRequest $request): JsonResponse
    {
        $model = StoreCountryAction::run($request->validated());
        return Response::data(
            CountryResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('country.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/country/{country}",
     *     operationId="updateCountry",
     *     tags={"Country"},
     *     summary="Update existing country",
     *     description="Returns updated country data",
     *     @OA\Parameter(name="country",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCountryRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateCountryRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CountryResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateCountryRequest $request, Country $country): JsonResponse
    {
        $data = UpdateCountryAction::run($country, $request->all());
        return Response::data(
            CountryResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('country.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/country/{country}",
     *      operationId="deleteCountry",
     *      tags={"Country"},
     *      summary="Delete existing country",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="country",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Country $country): JsonResponse
    {
        DeleteCountryAction::run($country);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('country.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/country/toggle/{country}",
//     *     operationId="toggleCountry",
//     *     tags={"Country"},
//     *     summary="Toggle Country",
//     *     description="Toggle Country",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/CountryResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Country $country): JsonResponse
//    {
//        $category = ToggleCountryAction::run($country);
//
//        return Response::data(
//            CountryResource::make($country),
//            trans('general.model_has_toggled_successfully', ['model' => trans('country.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/country/data",
//     *     operationId="getCountryData",
//     *     tags={"Country"},
//     *     summary="Get Country data",
//     *     description="Returns Country data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/CountryResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Country::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
