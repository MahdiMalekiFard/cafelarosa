<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Blog;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateBlogRequest;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Resources\BlogResource;
use App\Actions\Blog\StoreBlogAction;
use App\Actions\Blog\DeleteBlogAction;
use App\Actions\Blog\UpdateBlogAction;
use App\Repositories\Blog\BlogRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class BlogController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Blog::class);
    }

    /**
     * @OA\Get(
     *     path="/blog",
     *     operationId="getBlogs",
     *     tags={"Blog"},
     *     summary="get blogs list",
     *     description="Returns list of blogs",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/BlogResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(BlogRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            BlogResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Blog::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/blog/{blog}",
     *     operationId="getBlogByID",
     *     tags={"Blog"},
     *     summary="Get blog information",
     *     description="Returns blog data",
     *     @OA\Parameter(name="blog", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/BlogResource")
     *          )
     *      )
     * )
     */
    public function show(Blog $blog): JsonResponse
    {
        return Response::data(
            BlogDetailResource::make($blog),
        );
    }

    /**
     * @OA\Post(
     *     path="/blog",
     *     operationId="storeBlog",
     *     tags={"Blog"},
     *     summary="Store new blog",
     *     description="Returns new blog data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreBlogRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreBlogRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/BlogResource")
     *          )
     *      )
     * )
     */
    public function store(StoreBlogRequest $request): JsonResponse
    {
        $model = StoreBlogAction::run($request->validated());
        return Response::data(
            BlogResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('blog.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/blog/{blog}",
     *     operationId="updateBlog",
     *     tags={"Blog"},
     *     summary="Update existing blog",
     *     description="Returns updated blog data",
     *     @OA\Parameter(name="blog",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateBlogRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateBlogRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/BlogResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateBlogRequest $request, Blog $blog): JsonResponse
    {
        $data = UpdateBlogAction::run($blog, $request->all());
        return Response::data(
            BlogResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('blog.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/blog/{blog}",
     *      operationId="deleteBlog",
     *      tags={"Blog"},
     *      summary="Delete existing blog",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="blog",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Blog $blog): JsonResponse
    {
        DeleteBlogAction::run($blog);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('blog.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/blog/toggle/{blog}",
//     *     operationId="toggleBlog",
//     *     tags={"Blog"},
//     *     summary="Toggle Blog",
//     *     description="Toggle Blog",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/BlogResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Blog $blog): JsonResponse
//    {
//        $category = ToggleBlogAction::run($blog);
//
//        return Response::data(
//            BlogResource::make($blog),
//            trans('general.model_has_toggled_successfully', ['model' => trans('blog.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/blog/data",
//     *     operationId="getBlogData",
//     *     tags={"Blog"},
//     *     summary="Get Blog data",
//     *     description="Returns Blog data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/BlogResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Blog::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
