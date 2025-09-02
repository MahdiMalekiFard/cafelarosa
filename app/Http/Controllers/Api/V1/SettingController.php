<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateSettingRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Resources\SettingResource;
use App\Actions\Setting\StoreSettingAction;
use App\Actions\Setting\DeleteSettingAction;
use App\Actions\Setting\UpdateSettingAction;
use App\Repositories\Setting\SettingRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class SettingController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Setting::class);
    }

    /**
     * @OA\Get(
     *     path="/setting",
     *     operationId="getSettings",
     *     tags={"Setting"},
     *     summary="get settings list",
     *     description="Returns list of settings",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/SettingResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(SettingRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            SettingResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Setting::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/setting/{setting}",
     *     operationId="getSettingByID",
     *     tags={"Setting"},
     *     summary="Get setting information",
     *     description="Returns setting data",
     *     @OA\Parameter(name="setting", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/SettingResource")
     *          )
     *      )
     * )
     */
    public function show(Setting $setting): JsonResponse
    {
        return Response::data(
            SettingDetailResource::make($setting),
        );
    }

    /**
     * @OA\Post(
     *     path="/setting",
     *     operationId="storeSetting",
     *     tags={"Setting"},
     *     summary="Store new setting",
     *     description="Returns new setting data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreSettingRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreSettingRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/SettingResource")
     *          )
     *      )
     * )
     */
    public function store(StoreSettingRequest $request): JsonResponse
    {
        $model = StoreSettingAction::run($request->validated());
        return Response::data(
            SettingResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('setting.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/setting/{setting}",
     *     operationId="updateSetting",
     *     tags={"Setting"},
     *     summary="Update existing setting",
     *     description="Returns updated setting data",
     *     @OA\Parameter(name="setting",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateSettingRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateSettingRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/SettingResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateSettingRequest $request, Setting $setting): JsonResponse
    {
        $data = UpdateSettingAction::run($setting, $request->all());
        return Response::data(
            SettingResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('setting.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/setting/{setting}",
     *      operationId="deleteSetting",
     *      tags={"Setting"},
     *      summary="Delete existing setting",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="setting",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Setting $setting): JsonResponse
    {
        DeleteSettingAction::run($setting);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('setting.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/setting/toggle/{setting}",
//     *     operationId="toggleSetting",
//     *     tags={"Setting"},
//     *     summary="Toggle Setting",
//     *     description="Toggle Setting",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/SettingResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Setting $setting): JsonResponse
//    {
//        $category = ToggleSettingAction::run($setting);
//
//        return Response::data(
//            SettingResource::make($setting),
//            trans('general.model_has_toggled_successfully', ['model' => trans('setting.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/setting/data",
//     *     operationId="getSettingData",
//     *     tags={"Setting"},
//     *     summary="Get Setting data",
//     *     description="Returns Setting data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/SettingResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Setting::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
