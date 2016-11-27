<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAPostsAPIRequest;
use App\Http\Requests\API\UpdateAPostsAPIRequest;
use App\Models\APosts;
use App\Repositories\APostsRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class APostsController
 * @package App\Http\Controllers\API
 */

class APostsAPIController extends AppBaseController
{
    /** @var  APostsRepository */
    private $aPostsRepository;

    public function __construct(APostsRepository $aPostsRepo)
    {
        $this->aPostsRepository = $aPostsRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/aPosts",
     *      summary="Get a listing of the APosts.",
     *      tags={"APosts"},
     *      description="Get all APosts",
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
     *                  @SWG\Items(ref="#/definitions/APosts")
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
        $this->aPostsRepository->pushCriteria(new RequestCriteria($request));
        $this->aPostsRepository->pushCriteria(new LimitOffsetCriteria($request));
        $aPosts = $this->aPostsRepository->all();

        return $this->sendResponse($aPosts->toArray(), 'A Posts retrieved successfully');
    }

    /**
     * @param CreateAPostsAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/aPosts",
     *      summary="Store a newly created APosts in storage",
     *      tags={"APosts"},
     *      description="Store APosts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="APosts that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/APosts")
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
     *                  ref="#/definitions/APosts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAPostsAPIRequest $request)
    {
        $input = $request->all();

        $aPosts = $this->aPostsRepository->create($input);

        return $this->sendResponse($aPosts->toArray(), 'A Posts saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/aPosts/{id}",
     *      summary="Display the specified APosts",
     *      tags={"APosts"},
     *      description="Get APosts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of APosts",
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
     *                  ref="#/definitions/APosts"
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
        /** @var APosts $aPosts */
        $aPosts = $this->aPostsRepository->findWithoutFail($id);

        if (empty($aPosts)) {
            return $this->sendError('A Posts not found');
        }

        return $this->sendResponse($aPosts->toArray(), 'A Posts retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAPostsAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/aPosts/{id}",
     *      summary="Update the specified APosts in storage",
     *      tags={"APosts"},
     *      description="Update APosts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of APosts",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="APosts that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/APosts")
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
     *                  ref="#/definitions/APosts"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAPostsAPIRequest $request)
    {
        $input = $request->all();

        /** @var APosts $aPosts */
        $aPosts = $this->aPostsRepository->findWithoutFail($id);

        if (empty($aPosts)) {
            return $this->sendError('A Posts not found');
        }

        $aPosts = $this->aPostsRepository->update($input, $id);

        return $this->sendResponse($aPosts->toArray(), 'APosts updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/aPosts/{id}",
     *      summary="Remove the specified APosts from storage",
     *      tags={"APosts"},
     *      description="Delete APosts",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of APosts",
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
        /** @var APosts $aPosts */
        $aPosts = $this->aPostsRepository->findWithoutFail($id);

        if (empty($aPosts)) {
            return $this->sendError('A Posts not found');
        }

        $aPosts->delete();

        return $this->sendResponse($id, 'A Posts deleted successfully');
    }
}
