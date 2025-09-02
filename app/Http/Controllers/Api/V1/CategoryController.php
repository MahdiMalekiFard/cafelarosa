<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Category;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Actions\Category\StoreCategoryAction;
use App\Actions\Category\DeleteCategoryAction;
use App\Actions\Category\UpdateCategoryAction;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CategoryController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Category::class);
    }

    /**
     * @OA\Get(
     *     path="/category",
     *     operationId="getCategorys",
     *     tags={"Category"},
     *     summary="get categorys list",
     *     description="Returns list of categorys",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/CategoryResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(CategoryRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            CategoryResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Category::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/category/{category}",
     *     operationId="getCategoryByID",
     *     tags={"Category"},
     *     summary="Get category information",
     *     description="Returns category data",
     *     @OA\Parameter(name="category", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CategoryResource")
     *          )
     *      )
     * )
     */
    public function show(Category $category): JsonResponse
    {
        return Response::data(
            CategoryDetailResource::make($category),
        );
    }

    /**
     * @OA\Post(
     *     path="/category",
     *     operationId="storeCategory",
     *     tags={"Category"},
     *     summary="Store new category",
     *     description="Returns new category data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCategoryRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreCategoryRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CategoryResource")
     *          )
     *      )
     * )
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $model = StoreCategoryAction::run($request->validated());
        return Response::data(
            CategoryResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('category.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/category/{category}",
     *     operationId="updateCategory",
     *     tags={"Category"},
     *     summary="Update existing category",
     *     description="Returns updated category data",
     *     @OA\Parameter(name="category",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCategoryRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateCategoryRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CategoryResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateCategoryRequest $request, Category $category): JsonResponse
    {
        $data = UpdateCategoryAction::run($category, $request->all());
        return Response::data(
            CategoryResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('category.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/category/{category}",
     *      operationId="deleteCategory",
     *      tags={"Category"},
     *      summary="Delete existing category",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="category",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Category $category): JsonResponse
    {
        DeleteCategoryAction::run($category);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('category.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/category/toggle/{category}",
//     *     operationId="toggleCategory",
//     *     tags={"Category"},
//     *     summary="Toggle Category",
//     *     description="Toggle Category",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/CategoryResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Category $category): JsonResponse
//    {
//        $category = ToggleCategoryAction::run($category);
//
//        return Response::data(
//            CategoryResource::make($category),
//            trans('general.model_has_toggled_successfully', ['model' => trans('category.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/category/data",
//     *     operationId="getCategoryData",
//     *     tags={"Category"},
//     *     summary="Get Category data",
//     *     description="Returns Category data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/CategoryResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Category::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
