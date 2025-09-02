<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Profile;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateProfileRequest;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Resources\ProfileResource;
use App\Actions\Profile\StoreProfileAction;
use App\Actions\Profile\DeleteProfileAction;
use App\Actions\Profile\UpdateProfileAction;
use App\Repositories\Profile\ProfileRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ProfileController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Profile::class);
    }

    /**
     * @OA\Get(
     *     path="/profile",
     *     operationId="getProfiles",
     *     tags={"Profile"},
     *     summary="get profiles list",
     *     description="Returns list of profiles",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/ProfileResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(ProfileRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ProfileResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Profile::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/profile/{profile}",
     *     operationId="getProfileByID",
     *     tags={"Profile"},
     *     summary="Get profile information",
     *     description="Returns profile data",
     *     @OA\Parameter(name="profile", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ProfileResource")
     *          )
     *      )
     * )
     */
    public function show(Profile $profile): JsonResponse
    {
        return Response::data(
            ProfileDetailResource::make($profile),
        );
    }

    /**
     * @OA\Post(
     *     path="/profile",
     *     operationId="storeProfile",
     *     tags={"Profile"},
     *     summary="Store new profile",
     *     description="Returns new profile data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreProfileRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreProfileRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ProfileResource")
     *          )
     *      )
     * )
     */
    public function store(StoreProfileRequest $request): JsonResponse
    {
        $model = StoreProfileAction::run($request->validated());
        return Response::data(
            ProfileResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('profile.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/profile/{profile}",
     *     operationId="updateProfile",
     *     tags={"Profile"},
     *     summary="Update existing profile",
     *     description="Returns updated profile data",
     *     @OA\Parameter(name="profile",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateProfileRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateProfileRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ProfileResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateProfileRequest $request, Profile $profile): JsonResponse
    {
        $data = UpdateProfileAction::run($profile, $request->all());
        return Response::data(
            ProfileResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('profile.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/profile/{profile}",
     *      operationId="deleteProfile",
     *      tags={"Profile"},
     *      summary="Delete existing profile",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="profile",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Profile $profile): JsonResponse
    {
        DeleteProfileAction::run($profile);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('profile.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/profile/toggle/{profile}",
//     *     operationId="toggleProfile",
//     *     tags={"Profile"},
//     *     summary="Toggle Profile",
//     *     description="Toggle Profile",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ProfileResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Profile $profile): JsonResponse
//    {
//        $category = ToggleProfileAction::run($profile);
//
//        return Response::data(
//            ProfileResource::make($profile),
//            trans('general.model_has_toggled_successfully', ['model' => trans('profile.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/profile/data",
//     *     operationId="getProfileData",
//     *     tags={"Profile"},
//     *     summary="Get Profile data",
//     *     description="Returns Profile data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ProfileResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Profile::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
