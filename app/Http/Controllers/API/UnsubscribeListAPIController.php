<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateUnsubscribeListAPIRequest;
use App\Http\Requests\API\UpdateUnsubscribeListAPIRequest;
use App\Models\UnsubscribeList;
use App\Repositories\UnsubscribeListRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class UnsubscribeListController
 * @package App\Http\Controllers\API
 */

class UnsubscribeListAPIController extends AppBaseController
{
    /** @var  UnsubscribeListRepository */
    private $unsubscribeListRepository;

    public function __construct(UnsubscribeListRepository $unsubscribeListRepo)
    {
        $this->unsubscribeListRepository = $unsubscribeListRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/unsubscribeLists",
     *      summary="Get a listing of the UnsubscribeLists.",
     *      tags={"UnsubscribeList"},
     *      description="Get all UnsubscribeLists",
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
     *                  @SWG\Items(ref="#/definitions/UnsubscribeList")
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
        $this->unsubscribeListRepository->pushCriteria(new RequestCriteria($request));
        $this->unsubscribeListRepository->pushCriteria(new LimitOffsetCriteria($request));
        $unsubscribeLists = $this->unsubscribeListRepository->all();

        return $this->sendResponse($unsubscribeLists->toArray(), 'Unsubscribe Lists retrieved successfully');
    }

    /**
     * @param CreateUnsubscribeListAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/unsubscribeLists",
     *      summary="Store a newly created UnsubscribeList in storage",
     *      tags={"UnsubscribeList"},
     *      description="Store UnsubscribeList",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UnsubscribeList that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UnsubscribeList")
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
     *                  ref="#/definitions/UnsubscribeList"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateUnsubscribeListAPIRequest $request)
    {
        $input = $request->all();

        $unsubscribeLists = $this->unsubscribeListRepository->create($input);

        return $this->sendResponse($unsubscribeLists->toArray(), 'Unsubscribe List saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/unsubscribeLists/{id}",
     *      summary="Display the specified UnsubscribeList",
     *      tags={"UnsubscribeList"},
     *      description="Get UnsubscribeList",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UnsubscribeList",
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
     *                  ref="#/definitions/UnsubscribeList"
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
        /** @var UnsubscribeList $unsubscribeList */
        $unsubscribeList = $this->unsubscribeListRepository->findWithoutFail($id);

        if (empty($unsubscribeList)) {
            return $this->sendError('Unsubscribe List not found');
        }

        return $this->sendResponse($unsubscribeList->toArray(), 'Unsubscribe List retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateUnsubscribeListAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/unsubscribeLists/{id}",
     *      summary="Update the specified UnsubscribeList in storage",
     *      tags={"UnsubscribeList"},
     *      description="Update UnsubscribeList",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UnsubscribeList",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="UnsubscribeList that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/UnsubscribeList")
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
     *                  ref="#/definitions/UnsubscribeList"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateUnsubscribeListAPIRequest $request)
    {
        $input = $request->all();

        /** @var UnsubscribeList $unsubscribeList */
        $unsubscribeList = $this->unsubscribeListRepository->findWithoutFail($id);

        if (empty($unsubscribeList)) {
            return $this->sendError('Unsubscribe List not found');
        }

        $unsubscribeList = $this->unsubscribeListRepository->update($input, $id);

        return $this->sendResponse($unsubscribeList->toArray(), 'UnsubscribeList updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/unsubscribeLists/{id}",
     *      summary="Remove the specified UnsubscribeList from storage",
     *      tags={"UnsubscribeList"},
     *      description="Delete UnsubscribeList",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of UnsubscribeList",
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
        /** @var UnsubscribeList $unsubscribeList */
        $unsubscribeList = $this->unsubscribeListRepository->findWithoutFail($id);

        if (empty($unsubscribeList)) {
            return $this->sendError('Unsubscribe List not found');
        }

        $unsubscribeList->delete();

        return $this->sendResponse($id, 'Unsubscribe List deleted successfully');
    }
}
