<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePlaceAPIRequest;
use App\Http\Requests\API\UpdatePlaceAPIRequest;
use App\Models\Place;
use App\Repositories\PlaceRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class PlaceController
 * @package App\Http\Controllers\API
 */

class PlaceAPIController extends AppBaseController
{
    /** @var  PlaceRepository */
    private $placeRepository;

    public function __construct(PlaceRepository $placeRepo)
    {
        $this->placeRepository = $placeRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/places",
     *      summary="Get a listing of the Places.",
     *      tags={"Place"},
     *      description="Get all Places",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Place")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->placeRepository->pushCriteria(new RequestCriteria($request));
        $this->placeRepository->pushCriteria(new LimitOffsetCriteria($request));
        $places = $this->placeRepository->all();

        return $this->sendResponse($places->toArray(), 'Places retrieved successfully');
    }

    /**
     * @param CreatePlaceAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/places",
     *      summary="Store a newly created Place in storage",
     *      tags={"Place"},
     *      description="Store Place",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Place that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Place")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Place"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreatePlaceAPIRequest $request)
    {
        $input = $request->all();

        $places = $this->placeRepository->create($input);

        return $this->sendResponse($places->toArray(), 'Place saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/places/{id}",
     *      summary="Display the specified Place",
     *      tags={"Place"},
     *      description="Get Place",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Place",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Place"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Place $place */
        $place = $this->placeRepository->findWithoutFail($id);

        if (empty($place)) {
            return $this->sendError('Place not found');
        }

        return $this->sendResponse($place->toArray(), 'Place retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdatePlaceAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/places/{id}",
     *      summary="Update the specified Place in storage",
     *      tags={"Place"},
     *      description="Update Place",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Place",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Place that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Place")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Place"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdatePlaceAPIRequest $request)
    {
        $input = $request->all();

        /** @var Place $place */
        $place = $this->placeRepository->findWithoutFail($id);

        if (empty($place)) {
            return $this->sendError('Place not found');
        }

        $place = $this->placeRepository->update($input, $id);

        return $this->sendResponse($place->toArray(), 'Place updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/places/{id}",
     *      summary="Remove the specified Place from storage",
     *      tags={"Place"},
     *      description="Delete Place",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Place",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Place $place */
        $place = $this->placeRepository->findWithoutFail($id);

        if (empty($place)) {
            return $this->sendError('Place not found');
        }

        $place->delete();

        return $this->sendResponse($id, 'Place deleted successfully');
    }
}
