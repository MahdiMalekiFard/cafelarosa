<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Menu;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateMenuRequest;
use App\Http\Requests\StoreMenuRequest;
use App\Http\Resources\MenuResource;
use App\Actions\Menu\StoreMenuAction;
use App\Actions\Menu\DeleteMenuAction;
use App\Actions\Menu\UpdateMenuAction;
use App\Repositories\Menu\MenuRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class MenuController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Menu::class);
    }

    /**
     * @OA\Get(
     *     path="/menu",
     *     operationId="getMenus",
     *     tags={"Menu"},
     *     summary="get menus list",
     *     description="Returns list of menus",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/MenuResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(MenuRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            MenuResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Menu::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/menu/{menu}",
     *     operationId="getMenuByID",
     *     tags={"Menu"},
     *     summary="Get menu information",
     *     description="Returns menu data",
     *     @OA\Parameter(name="menu", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/MenuResource")
     *          )
     *      )
     * )
     */
    public function show(Menu $menu): JsonResponse
    {
        return Response::data(
            MenuDetailResource::make($menu),
        );
    }

    /**
     * @OA\Post(
     *     path="/menu",
     *     operationId="storeMenu",
     *     tags={"Menu"},
     *     summary="Store new menu",
     *     description="Returns new menu data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreMenuRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreMenuRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/MenuResource")
     *          )
     *      )
     * )
     */
    public function store(StoreMenuRequest $request): JsonResponse
    {
        $model = StoreMenuAction::run($request->validated());
        return Response::data(
            MenuResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('menu.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/menu/{menu}",
     *     operationId="updateMenu",
     *     tags={"Menu"},
     *     summary="Update existing menu",
     *     description="Returns updated menu data",
     *     @OA\Parameter(name="menu",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateMenuRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateMenuRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/MenuResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateMenuRequest $request, Menu $menu): JsonResponse
    {
        $data = UpdateMenuAction::run($menu, $request->all());
        return Response::data(
            MenuResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('menu.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/menu/{menu}",
     *      operationId="deleteMenu",
     *      tags={"Menu"},
     *      summary="Delete existing menu",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="menu",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Menu $menu): JsonResponse
    {
        DeleteMenuAction::run($menu);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('menu.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/menu/toggle/{menu}",
//     *     operationId="toggleMenu",
//     *     tags={"Menu"},
//     *     summary="Toggle Menu",
//     *     description="Toggle Menu",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/MenuResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Menu $menu): JsonResponse
//    {
//        $category = ToggleMenuItemAction::run($menu);
//
//        return Response::data(
//            MenuResource::make($menu),
//            trans('general.model_has_toggled_successfully', ['model' => trans('menu.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/menu/data",
//     *     operationId="getMenuData",
//     *     tags={"Menu"},
//     *     summary="Get Menu data",
//     *     description="Returns Menu data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/MenuResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Menu::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
