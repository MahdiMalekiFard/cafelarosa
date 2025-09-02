<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\ActivationCode;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateActivationCodeRequest;
use App\Http\Requests\StoreActivationCodeRequest;
use App\Http\Resources\ActivationCodeResource;
use App\Actions\ActivationCode\StoreActivationCodeAction;
use App\Actions\ActivationCode\DeleteActivationCodeAction;
use App\Actions\ActivationCode\UpdateActivationCodeAction;
use App\Repositories\ActivationCode\ActivationCodeRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ActivationCodeController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(ActivationCode::class);
    }

    /**
     * @OA\Get(
     *     path="/activation-code",
     *     operationId="getActivationCodes",
     *     tags={"ActivationCode"},
     *     summary="get activationCodes list",
     *     description="Returns list of activationCodes",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/ActivationCodeResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(ActivationCodeRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ActivationCodeResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(ActivationCode::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/activation-code/{activationCode}",
     *     operationId="getActivationCodeByID",
     *     tags={"ActivationCode"},
     *     summary="Get activationCode information",
     *     description="Returns activationCode data",
     *     @OA\Parameter(name="activationCode", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ActivationCodeResource")
     *          )
     *      )
     * )
     */
    public function show(ActivationCode $activationCode): JsonResponse
    {
        return Response::data(
            ActivationCodeDetailResource::make($activationCode),
        );
    }

    /**
     * @OA\Post(
     *     path="/activation-code",
     *     operationId="storeActivationCode",
     *     tags={"ActivationCode"},
     *     summary="Store new activationCode",
     *     description="Returns new activationCode data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreActivationCodeRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreActivationCodeRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ActivationCodeResource")
     *          )
     *      )
     * )
     */
    public function store(StoreActivationCodeRequest $request): JsonResponse
    {
        $model = StoreActivationCodeAction::run($request->validated());
        return Response::data(
            ActivationCodeResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('activationCode.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/activation-code/{activationCode}",
     *     operationId="updateActivationCode",
     *     tags={"ActivationCode"},
     *     summary="Update existing activationCode",
     *     description="Returns updated activationCode data",
     *     @OA\Parameter(name="activationCode",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateActivationCodeRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateActivationCodeRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ActivationCodeResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateActivationCodeRequest $request, ActivationCode $activationCode): JsonResponse
    {
        $data = UpdateActivationCodeAction::run($activationCode, $request->all());
        return Response::data(
            ActivationCodeResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('activationCode.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/activation-code/{activationCode}",
     *      operationId="deleteActivationCode",
     *      tags={"ActivationCode"},
     *      summary="Delete existing activationCode",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="activationCode",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(ActivationCode $activationCode): JsonResponse
    {
        DeleteActivationCodeAction::run($activationCode);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('activationCode.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/activation-code/toggle/{activationCode}",
//     *     operationId="toggleActivationCode",
//     *     tags={"ActivationCode"},
//     *     summary="Toggle ActivationCode",
//     *     description="Toggle ActivationCode",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ActivationCodeResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(ActivationCode $activationCode): JsonResponse
//    {
//        $category = ToggleActivationCodeAction::run($activationCode);
//
//        return Response::data(
//            ActivationCodeResource::make($activationCode),
//            trans('general.model_has_toggled_successfully', ['model' => trans('activationCode.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/activation-code/data",
//     *     operationId="getActivationCodeData",
//     *     tags={"ActivationCode"},
//     *     summary="Get ActivationCode data",
//     *     description="Returns ActivationCode data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ActivationCodeResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', ActivationCode::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
