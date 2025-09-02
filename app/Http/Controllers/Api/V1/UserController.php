<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Resources\UserResource;
use App\Actions\User\StoreUserAction;
use App\Actions\User\DeleteUserAction;
use App\Actions\User\UpdateUserAction;
use App\Repositories\User\UserRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class UserController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(User::class);
    }

    /**
     * @OA\Get(
     *     path="/user",
     *     operationId="getUsers",
     *     tags={"User"},
     *     summary="get users list",
     *     description="Returns list of users",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/UserResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(UserRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            UserResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(User::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/user/{user}",
     *     operationId="getUserByID",
     *     tags={"User"},
     *     summary="Get user information",
     *     description="Returns user data",
     *     @OA\Parameter(name="user", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/UserResource")
     *          )
     *      )
     * )
     */
    public function show(User $user): JsonResponse
    {
        return Response::data(
            UserDetailResource::make($user),
        );
    }

    /**
     * @OA\Post(
     *     path="/user",
     *     operationId="storeUser",
     *     tags={"User"},
     *     summary="Store new user",
     *     description="Returns new user data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreUserRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreUserRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/UserResource")
     *          )
     *      )
     * )
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $model = StoreUserAction::run($request->validated());
        return Response::data(
            UserResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('user.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/user/{user}",
     *     operationId="updateUser",
     *     tags={"User"},
     *     summary="Update existing user",
     *     description="Returns updated user data",
     *     @OA\Parameter(name="user",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateUserRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateUserRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/UserResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateUserRequest $request, User $user): JsonResponse
    {
        $data = UpdateUserAction::run($user, $request->all());
        return Response::data(
            UserResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('user.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/user/{user}",
     *      operationId="deleteUser",
     *      tags={"User"},
     *      summary="Delete existing user",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="user",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(User $user): JsonResponse
    {
        DeleteUserAction::run($user);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('user.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/user/toggle/{user}",
//     *     operationId="toggleUser",
//     *     tags={"User"},
//     *     summary="Toggle User",
//     *     description="Toggle User",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/UserResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(User $user): JsonResponse
//    {
//        $category = ToggleUserAction::run($user);
//
//        return Response::data(
//            UserResource::make($user),
//            trans('general.model_has_toggled_successfully', ['model' => trans('user.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/user/data",
//     *     operationId="getUserData",
//     *     tags={"User"},
//     *     summary="Get User data",
//     *     description="Returns User data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/UserResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', User::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
