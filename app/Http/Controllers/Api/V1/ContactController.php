<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Contact;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\UpdateContactRequest;
use App\Http\Requests\StoreContactRequest;
use App\Http\Resources\ContactResource;
use App\Actions\Contact\StoreContactAction;
use App\Actions\Contact\DeleteContactAction;
use App\Actions\Contact\UpdateContactAction;
use App\Repositories\Contact\ContactRepositoryInterface;
use App\Services\AdvancedSearchFields\AdvancedSearchFieldsService;
use Illuminate\Http\Response;
use OpenApi\Annotations as OA;

class ContactController extends BaseApiController
{

    public function __construct()
    {
        $this->middleware('auth:api');
        $this->authorizeResource(Contact::class);
    }

    /**
     * @OA\Get(
     *     path="/contact",
     *     operationId="getContacts",
     *     tags={"Contact"},
     *     summary="get contacts list",
     *     description="Returns list of contacts",
     *     @OA\Parameter(ref="#/components/parameters/Page"),
     *     @OA\Parameter(ref="#/components/parameters/PageLimit"),
     *     @OA\Parameter (ref="#/components/parameters/Filter"),
     *     @OA\Parameter (ref="#/components/parameters/AdvancedSearch"),
     *     @OA\Parameter(ref="#/components/parameters/Sort"),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",type="array",@OA\Items(ref="#/components/schemas/ContactResource")),
     *              @OA\Property(property="meta",ref="#/components/schemas/Meta")
     *          )
     *     )
     *     )
     */
    public function index(ContactRepositoryInterface $repository): JsonResponse
    {
        return Response::dataWithAdditional(
            ContactResource::collection($repository->paginate()),
            additional: [
                'advance_search_field' => AdvancedSearchFieldsService::generate(Contact::class),
                'extra'                => $repository->extra(),
            ]
        );
    }

    /**
     * @OA\Get(
     *     path="/contact/{contact}",
     *     operationId="getContactByID",
     *     tags={"Contact"},
     *     summary="Get contact information",
     *     description="Returns contact data",
     *     @OA\Parameter(name="contact", required=true,in="path", @OA\Schema(type="integer")),
     *     @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ContactResource")
     *          )
     *      )
     * )
     */
    public function show(Contact $contact): JsonResponse
    {
        return Response::data(
            ContactDetailResource::make($contact),
        );
    }

    /**
     * @OA\Post(
     *     path="/contact",
     *     operationId="storeContact",
     *     tags={"Contact"},
     *     summary="Store new contact",
     *     description="Returns new contact data",
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreContactRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/StoreContactRequest"))
     *     ),
     *     @OA\Response(response=201,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ContactResource")
     *          )
     *      )
     * )
     */
    public function store(StoreContactRequest $request): JsonResponse
    {
        $model = StoreContactAction::run($request->validated());
        return Response::data(
            ContactResource::make($model),
            trans('general.model_has_stored_successfully',['model'=>trans('contact.model')]),
            Response::HTTP_CREATED
        );
    }

    /**
     * @OA\Put(
     *     path="/contact/{contact}",
     *     operationId="updateContact",
     *     tags={"Contact"},
     *     summary="Update existing contact",
     *     description="Returns updated contact data",
     *     @OA\Parameter(name="contact",required=true,in="path",@OA\Schema(type="integer")),
     *     @OA\RequestBody(required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateContactRequest"),
     *          @OA\MediaType(mediaType="application/x-www-form-urlencoded",@OA\Schema(ref="#/components/schemas/UpdateContactRequest"))
     *     ),
     *     @OA\Response(response=202,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",
     *              @OA\Property(property="message",type="string",example="example message"),
     *              @OA\Property(property="data",ref="#/components/schemas/ContactResource")
     *          )
     *      )
     * )
     */
    public function update(UpdateContactRequest $request, Contact $contact): JsonResponse
    {
        $data = UpdateContactAction::run($contact, $request->all());
        return Response::data(
            ContactResource::make($data),
            trans('general.model_has_updated_successfully',['model'=>trans('contact.model')]),
            Response::HTTP_ACCEPTED
        );
    }

    /**
     * @OA\Delete(
     *      path="/contact/{contact}",
     *      operationId="deleteContact",
     *      tags={"Contact"},
     *      summary="Delete existing contact",
     *      description="Deletes a record and returns no content",
     *      @OA\Parameter(name="contact",required=true,in="path",@OA\Schema(type="integer")),
     *      @OA\Response(response=200,
     *          description="Successful operation",
     *          @OA\JsonContent(type="object",@OA\Property(property="message",type="string",example="example message"))
     *      )
     * )
     */
    public function destroy(Contact $contact): JsonResponse
    {
        DeleteContactAction::run($contact);
        return Response::data(
            true,
            trans('general.model_has_deleted_successfully',['model'=>trans('contact.model')]),
            Response::HTTP_OK
        );
    }

//    /**
//     * @OA\Get(
//     *     path="/contact/toggle/{contact}",
//     *     operationId="toggleContact",
//     *     tags={"Contact"},
//     *     summary="Toggle Contact",
//     *     description="Toggle Contact",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ContactResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function toggle(Contact $contact): JsonResponse
//    {
//        $category = ToggleContactAction::run($contact);
//
//        return Response::data(
//            ContactResource::make($contact),
//            trans('general.model_has_toggled_successfully', ['model' => trans('contact.model')]),
//            Response::HTTP_OK
//        );
//    }
//
//    /**
//     * @OA\Get(
//     *     path="/contact/data",
//     *     operationId="getContactData",
//     *     tags={"Contact"},
//     *     summary="Get Contact data",
//     *     description="Returns Contact data",
//     *     @OA\Response(response=200,
//     *         description="Successful operation",
//     *         @OA\JsonContent(type="object",
//     *             @OA\Property(property="message", type="string", example="example message"),
//     *             @OA\Property(property="data", type="object",
//     *                 @OA\Property(property="user", ref="#/components/schemas/ContactResource")
//     *             )
//     *         )
//     *     )
//     * )
//     */
//    public function extraData(Request $request): JsonResponse
//    {
//        $this->authorize('create', Contact::class);
//        return Response::data(
//            [
//                'user'  => $request->user()
//            ]
//        );
//    }
}
