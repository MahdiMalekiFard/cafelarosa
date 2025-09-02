<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Opinion;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateOpinionRequest;
use App\Http\Requests\StoreOpinionRequest;
use App\Http\Resources\OpinionResource;
use App\Actions\Opinion\StoreOpinionAction;
use App\Actions\Opinion\DeleteOpinionAction;
use App\Actions\Opinion\UpdateOpinionAction;
use App\Repositories\Opinion\OpinionRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class OpinionController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Opinion::class);
    }

    /**
     * @OA\Get(
     *     path="/opinion",
     *     operationId="getOpinions",
     *     tags={"Opinion"},
     *     summary="get opinions list",
     *     description="Returns list of opinions",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/OpinionResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(OpinionRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            OpinionResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Opinion::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/opinion/{opinion}",
     *     operationId="getOpinionByID",
     *     tags={"Opinion"},
     *     summary="Get opinion information",
     *     description="Returns opinion data",
     *     @OA\Parameter(name="opinion", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/OpinionResource")
     *          )
     *      )
     * )
     */
    public function show(Opinion $opinion): JsonResponse
    {
        return Response::data(
            OpinionDetailResource::make($opinion),
        );
    }

    /**
     * @OA\Post(
     *     path="/opinion",
     *     operationId="storeOpinion",
     *     tags={"Opinion"},
     *     summary="Store new opinion",
     *     description="Returns new opinion data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreOpinionRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreOpinionRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/OpinionResource")
     *          )
     *      )
     * )
     */
    public function store(StoreOpinionRequest $request): JsonResponse
    {
        $model = StoreOpinionAction::run($request->validated());
        return Response::data(
            OpinionResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('opinion.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/opinion/{opinion}",
     *     operationId="updateOpinion",
     *     tags={"Opinion"},
     *     summary="Update existing opinion",
     *     description="Returns updated opinion data",
     *     @OA\Parameter(name="opinion",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateOpinionRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateOpinionRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/OpinionResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateOpinionRequest $request, Opinion $opinion): JsonResponse
    {
        $data = UpdateOpinionAction::run($opinion, $request->all());
        return Response::data(
            OpinionResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('opinion.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/opinion/{opinion}",
     *      operationId="deleteOpinion",
     *      tags={"Opinion"},
     *      summary="Delete existing opinion",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="opinion",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Opinion $opinion): JsonResponse
    {
        DeleteOpinionAction::run($opinion);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('opinion.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/opinion/toggle/{opinion}",
//     *     operationId="toggleOpinion",
//     *     tags={"Opinion"},
//     *     summary="Toggle Opinion",
//     *     description="Toggle Opinion",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/OpinionResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Opinion $opinion): JsonResponse
//    {
//        $category = ToggleOpinionAction::run($opinion);
//
//        return Response::data(
//            OpinionResource::make($opinion),
//            trans('general.model_has_toggled_successfully', ['model' => trans('opinion.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/opinion/data",
//     *     operationId="getOpinionData",
//     *     tags={"Opinion"},
//     *     summary="Get Opinion data",
//     *     description="Returns Opinion data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/OpinionResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Opinion::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
