<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Comment;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Actions\Comment\StoreCommentAction;
use App\Actions\Comment\DeleteCommentAction;
use App\Actions\Comment\UpdateCommentAction;
use App\Repositories\Comment\CommentRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class CommentController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Comment::class);
    }

    /**
     * @OA\Get(
     *     path="/comment",
     *     operationId="getComments",
     *     tags={"Comment"},
     *     summary="get comments list",
     *     description="Returns list of comments",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/CommentResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(CommentRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            CommentResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Comment::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/comment/{comment}",
     *     operationId="getCommentByID",
     *     tags={"Comment"},
     *     summary="Get comment information",
     *     description="Returns comment data",
     *     @OA\Parameter(name="comment", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CommentResource")
     *          )
     *      )
     * )
     */
    public function show(Comment $comment): JsonResponse
    {
        return Response::data(
            CommentDetailResource::make($comment),
        );
    }

    /**
     * @OA\Post(
     *     path="/comment",
     *     operationId="storeComment",
     *     tags={"Comment"},
     *     summary="Store new comment",
     *     description="Returns new comment data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCommentRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreCommentRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CommentResource")
     *          )
     *      )
     * )
     */
    public function store(StoreCommentRequest $request): JsonResponse
    {
        $model = StoreCommentAction::run($request->validated());
        return Response::data(
            CommentResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('comment.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/comment/{comment}",
     *     operationId="updateComment",
     *     tags={"Comment"},
     *     summary="Update existing comment",
     *     description="Returns updated comment data",
     *     @OA\Parameter(name="comment",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCommentRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateCommentRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/CommentResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateCommentRequest $request, Comment $comment): JsonResponse
    {
        $data = UpdateCommentAction::run($comment, $request->all());
        return Response::data(
            CommentResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('comment.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/comment/{comment}",
     *      operationId="deleteComment",
     *      tags={"Comment"},
     *      summary="Delete existing comment",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="comment",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Comment $comment): JsonResponse
    {
        DeleteCommentAction::run($comment);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('comment.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/comment/toggle/{comment}",
//     *     operationId="toggleComment",
//     *     tags={"Comment"},
//     *     summary="Toggle Comment",
//     *     description="Toggle Comment",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/CommentResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Comment $comment): JsonResponse
//    {
//        $category = ToggleCommentAction::run($comment);
//
//        return Response::data(
//            CommentResource::make($comment),
//            trans('general.model_has_toggled_successfully', ['model' => trans('comment.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/comment/data",
//     *     operationId="getCommentData",
//     *     tags={"Comment"},
//     *     summary="Get Comment data",
//     *     description="Returns Comment data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/CommentResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Comment::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
