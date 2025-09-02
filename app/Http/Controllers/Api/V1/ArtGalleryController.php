<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\ArtGallery;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateArtGalleryRequest;
use App\Http\Requests\StoreArtGalleryRequest;
use App\Http\Resources\ArtGalleryResource;
use App\Actions\ArtGallery\StoreArtGalleryAction;
use App\Actions\ArtGallery\DeleteArtGalleryAction;
use App\Actions\ArtGallery\UpdateArtGalleryAction;
use App\Repositories\ArtGallery\ArtGalleryRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ArtGalleryController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(ArtGallery::class);
    }

    /**
     * @OA\Get(
     *     path="/art-gallery",
     *     operationId="getArtGallerys",
     *     tags={"ArtGallery"},
     *     summary="get artGallerys list",
     *     description="Returns list of artGallerys",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/ArtGalleryResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(ArtGalleryRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ArtGalleryResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(ArtGallery::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/art-gallery/{artGallery}",
     *     operationId="getArtGalleryByID",
     *     tags={"ArtGallery"},
     *     summary="Get artGallery information",
     *     description="Returns artGallery data",
     *     @OA\Parameter(name="artGallery", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ArtGalleryResource")
     *          )
     *      )
     * )
     */
    public function show(ArtGallery $artGallery): JsonResponse
    {
        return Response::data(
            ArtGalleryDetailResource::make($artGallery),
        );
    }

    /**
     * @OA\Post(
     *     path="/art-gallery",
     *     operationId="storeArtGallery",
     *     tags={"ArtGallery"},
     *     summary="Store new artGallery",
     *     description="Returns new artGallery data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreArtGalleryRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreArtGalleryRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ArtGalleryResource")
     *          )
     *      )
     * )
     */
    public function store(StoreArtGalleryRequest $request): JsonResponse
    {
        $model = StoreArtGalleryAction::run($request->validated());
        return Response::data(
            ArtGalleryResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('artGallery.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/art-gallery/{artGallery}",
     *     operationId="updateArtGallery",
     *     tags={"ArtGallery"},
     *     summary="Update existing artGallery",
     *     description="Returns updated artGallery data",
     *     @OA\Parameter(name="artGallery",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateArtGalleryRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateArtGalleryRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ArtGalleryResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateArtGalleryRequest $request, ArtGallery $artGallery): JsonResponse
    {
        $data = UpdateArtGalleryAction::run($artGallery, $request->all());
        return Response::data(
            ArtGalleryResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('artGallery.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/art-gallery/{artGallery}",
     *      operationId="deleteArtGallery",
     *      tags={"ArtGallery"},
     *      summary="Delete existing artGallery",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="artGallery",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(ArtGallery $artGallery): JsonResponse
    {
        DeleteArtGalleryAction::run($artGallery);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('artGallery.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/art-gallery/toggle/{artGallery}",
//     *     operationId="toggleArtGallery",
//     *     tags={"ArtGallery"},
//     *     summary="Toggle ArtGallery",
//     *     description="Toggle ArtGallery",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ArtGalleryResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(ArtGallery $artGallery): JsonResponse
//    {
//        $category = ToggleArtGalleryAction::run($artGallery);
//
//        return Response::data(
//            ArtGalleryResource::make($artGallery),
//            trans('general.model_has_toggled_successfully', ['model' => trans('artGallery.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/art-gallery/data",
//     *     operationId="getArtGalleryData",
//     *     tags={"ArtGallery"},
//     *     summary="Get ArtGallery data",
//     *     description="Returns ArtGallery data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ArtGalleryResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', ArtGallery::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
