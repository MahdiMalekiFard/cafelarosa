<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Slider;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateSliderRequest;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Resources\SliderResource;
use App\Actions\Slider\StoreSliderAction;
use App\Actions\Slider\DeleteSliderAction;
use App\Actions\Slider\UpdateSliderAction;
use App\Repositories\Slider\SliderRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class SliderController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Slider::class);
    }

    /**
     * @OA\Get(
     *     path="/slider",
     *     operationId="getSliders",
     *     tags={"Slider"},
     *     summary="get sliders list",
     *     description="Returns list of sliders",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/SliderResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(SliderRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            SliderResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Slider::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/slider/{slider}",
     *     operationId="getSliderByID",
     *     tags={"Slider"},
     *     summary="Get slider information",
     *     description="Returns slider data",
     *     @OA\Parameter(name="slider", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/SliderResource")
     *          )
     *      )
     * )
     */
    public function show(Slider $slider): JsonResponse
    {
        return Response::data(
            SliderDetailResource::make($slider),
        );
    }

    /**
     * @OA\Post(
     *     path="/slider",
     *     operationId="storeSlider",
     *     tags={"Slider"},
     *     summary="Store new slider",
     *     description="Returns new slider data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreSliderRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreSliderRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/SliderResource")
     *          )
     *      )
     * )
     */
    public function store(StoreSliderRequest $request): JsonResponse
    {
        $model = StoreSliderAction::run($request->validated());
        return Response::data(
            SliderResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('slider.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/slider/{slider}",
     *     operationId="updateSlider",
     *     tags={"Slider"},
     *     summary="Update existing slider",
     *     description="Returns updated slider data",
     *     @OA\Parameter(name="slider",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateSliderRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateSliderRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/SliderResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateSliderRequest $request, Slider $slider): JsonResponse
    {
        $data = UpdateSliderAction::run($slider, $request->all());
        return Response::data(
            SliderResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('slider.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/slider/{slider}",
     *      operationId="deleteSlider",
     *      tags={"Slider"},
     *      summary="Delete existing slider",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="slider",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Slider $slider): JsonResponse
    {
        DeleteSliderAction::run($slider);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('slider.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/slider/toggle/{slider}",
//     *     operationId="toggleSlider",
//     *     tags={"Slider"},
//     *     summary="Toggle Slider",
//     *     description="Toggle Slider",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/SliderResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Slider $slider): JsonResponse
//    {
//        $category = ToggleSliderAction::run($slider);
//
//        return Response::data(
//            SliderResource::make($slider),
//            trans('general.model_has_toggled_successfully', ['model' => trans('slider.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/slider/data",
//     *     operationId="getSliderData",
//     *     tags={"Slider"},
//     *     summary="Get Slider data",
//     *     description="Returns Slider data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/SliderResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Slider::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
