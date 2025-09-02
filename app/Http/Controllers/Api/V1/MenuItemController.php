<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\MenuItem;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateMenuItemRequest;
use App\Http\Requests\StoreMenuItemRequest;
use App\Http\Resources\MenuItemResource;
use App\Actions\MenuItem\StoreMenuItemAction;
use App\Actions\MenuItem\DeleteMenuItemAction;
use App\Actions\MenuItem\UpdateMenuItemAction;
use App\Repositories\MenuItem\MenuItemRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class MenuItemController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(MenuItem::class);
    }

    /**
     * @OA\Get(
     *     path="/menu-item",
     *     operationId="getMenuItems",
     *     tags={"MenuItem"},
     *     summary="get menuItems list",
     *     description="Returns list of menuItems",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/MenuItemResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(MenuItemRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            MenuItemResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(MenuItem::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/menu-item/{menuItem}",
     *     operationId="getMenuItemByID",
     *     tags={"MenuItem"},
     *     summary="Get menuItem information",
     *     description="Returns menuItem data",
     *     @OA\Parameter(name="menuItem", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/MenuItemResource")
     *          )
     *      )
     * )
     */
    public function show(MenuItem $menuItem): JsonResponse
    {
        return Response::data(
            MenuItemDetailResource::make($menuItem),
        );
    }

    /**
     * @OA\Post(
     *     path="/menu-item",
     *     operationId="storeMenuItem",
     *     tags={"MenuItem"},
     *     summary="Store new menuItem",
     *     description="Returns new menuItem data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreMenuItemRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreMenuItemRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/MenuItemResource")
     *          )
     *      )
     * )
     */
    public function store(StoreMenuItemRequest $request): JsonResponse
    {
        $model = StoreMenuItemAction::run($request->validated());
        return Response::data(
            MenuItemResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('menuItem.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/menu-item/{menuItem}",
     *     operationId="updateMenuItem",
     *     tags={"MenuItem"},
     *     summary="Update existing menuItem",
     *     description="Returns updated menuItem data",
     *     @OA\Parameter(name="menuItem",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateMenuItemRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateMenuItemRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/MenuItemResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateMenuItemRequest $request, MenuItem $menuItem): JsonResponse
    {
        $data = UpdateMenuItemAction::run($menuItem, $request->all());
        return Response::data(
            MenuItemResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('menuItem.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/menu-item/{menuItem}",
     *      operationId="deleteMenuItem",
     *      tags={"MenuItem"},
     *      summary="Delete existing menuItem",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="menuItem",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(MenuItem $menuItem): JsonResponse
    {
        DeleteMenuItemAction::run($menuItem);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('menuItem.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/menu-item/toggle/{menuItem}",
//     *     operationId="toggleMenuItem",
//     *     tags={"MenuItem"},
//     *     summary="Toggle MenuItem",
//     *     description="Toggle MenuItem",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/MenuItemResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(MenuItem $menuItem): JsonResponse
//    {
//        $category = ToggleMenuItemAction::run($menuItem);
//
//        return Response::data(
//            MenuItemResource::make($menuItem),
//            trans('general.model_has_toggled_successfully', ['model' => trans('menuItem.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/menu-item/data",
//     *     operationId="getMenuItemData",
//     *     tags={"MenuItem"},
//     *     summary="Get MenuItem data",
//     *     description="Returns MenuItem data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/MenuItemResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', MenuItem::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
