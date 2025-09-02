<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Portfolio;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Resources\PortfolioResource;
use App\Actions\Portfolio\StorePortfolioAction;
use App\Actions\Portfolio\DeletePortfolioAction;
use App\Actions\Portfolio\UpdatePortfolioAction;
use App\Repositories\Portfolio\PortfolioRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class PortfolioController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Portfolio::class);
    }

    /**
     * @OA\Get(
     *     path="/portfolio",
     *     operationId="getPortfolios",
     *     tags={"Portfolio"},
     *     summary="get portfolios list",
     *     description="Returns list of portfolios",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/PortfolioResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(PortfolioRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            PortfolioResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Portfolio::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/portfolio/{portfolio}",
     *     operationId="getPortfolioByID",
     *     tags={"Portfolio"},
     *     summary="Get portfolio information",
     *     description="Returns portfolio data",
     *     @OA\Parameter(name="portfolio", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/PortfolioResource")
     *          )
     *      )
     * )
     */
    public function show(Portfolio $portfolio): JsonResponse
    {
        return Response::data(
            PortfolioDetailResource::make($portfolio),
        );
    }

    /**
     * @OA\Post(
     *     path="/portfolio",
     *     operationId="storePortfolio",
     *     tags={"Portfolio"},
     *     summary="Store new portfolio",
     *     description="Returns new portfolio data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePortfolioRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StorePortfolioRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/PortfolioResource")
     *          )
     *      )
     * )
     */
    public function store(StorePortfolioRequest $request): JsonResponse
    {
        $model = StorePortfolioAction::run($request->validated());
        return Response::data(
            PortfolioResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('portfolio.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/portfolio/{portfolio}",
     *     operationId="updatePortfolio",
     *     tags={"Portfolio"},
     *     summary="Update existing portfolio",
     *     description="Returns updated portfolio data",
     *     @OA\Parameter(name="portfolio",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePortfolioRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdatePortfolioRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/PortfolioResource")
     *          )
     *      )
     * )
     */
    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio): JsonResponse
    {
        $data = UpdatePortfolioAction::run($portfolio, $request->all());
        return Response::data(
            PortfolioResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('portfolio.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/portfolio/{portfolio}",
     *      operationId="deletePortfolio",
     *      tags={"Portfolio"},
     *      summary="Delete existing portfolio",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="portfolio",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Portfolio $portfolio): JsonResponse
    {
        DeletePortfolioAction::run($portfolio);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('portfolio.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/portfolio/toggle/{portfolio}",
//     *     operationId="togglePortfolio",
//     *     tags={"Portfolio"},
//     *     summary="Toggle Portfolio",
//     *     description="Toggle Portfolio",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/PortfolioResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Portfolio $portfolio): JsonResponse
//    {
//        $category = TogglePortfolioAction::run($portfolio);
//
//        return Response::data(
//            PortfolioResource::make($portfolio),
//            trans('general.model_has_toggled_successfully', ['model' => trans('portfolio.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/portfolio/data",
//     *     operationId="getPortfolioData",
//     *     tags={"Portfolio"},
//     *     summary="Get Portfolio data",
//     *     description="Returns Portfolio data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/PortfolioResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Portfolio::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
