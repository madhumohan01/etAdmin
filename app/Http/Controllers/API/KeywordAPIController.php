<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateKeywordAPIRequest;
use App\Http\Requests\API\UpdateKeywordAPIRequest;
use App\Models\Keyword;
use App\Repositories\KeywordRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class KeywordController
 * @package App\Http\Controllers\API
 */

class KeywordAPIController extends AppBaseController
{
    /** @var  KeywordRepository */
    private $keywordRepository;

    public function __construct(KeywordRepository $keywordRepo)
    {
        $this->keywordRepository = $keywordRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/keywords",
     *      summary="Get a listing of the Keywords.",
     *      tags={"Keyword"},
     *      description="Get all Keywords",
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
     *                  @SWG\Items(ref="#/definitions/Keyword")
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
        $this->keywordRepository->pushCriteria(new RequestCriteria($request));
        $this->keywordRepository->pushCriteria(new LimitOffsetCriteria($request));
        $keywords = $this->keywordRepository->all();

        return $this->sendResponse($keywords->toArray(), 'Keywords retrieved successfully');
    }

    /**
     * @param CreateKeywordAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/keywords",
     *      summary="Store a newly created Keyword in storage",
     *      tags={"Keyword"},
     *      description="Store Keyword",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Keyword that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Keyword")
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
     *                  ref="#/definitions/Keyword"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateKeywordAPIRequest $request)
    {
        $input = $request->all();

        $keywords = $this->keywordRepository->create($input);

        return $this->sendResponse($keywords->toArray(), 'Keyword saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/keywords/{id}",
     *      summary="Display the specified Keyword",
     *      tags={"Keyword"},
     *      description="Get Keyword",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Keyword",
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
     *                  ref="#/definitions/Keyword"
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
        /** @var Keyword $keyword */
        $keyword = $this->keywordRepository->findWithoutFail($id);

        if (empty($keyword)) {
            return $this->sendError('Keyword not found');
        }

        return $this->sendResponse($keyword->toArray(), 'Keyword retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateKeywordAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/keywords/{id}",
     *      summary="Update the specified Keyword in storage",
     *      tags={"Keyword"},
     *      description="Update Keyword",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Keyword",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Keyword that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Keyword")
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
     *                  ref="#/definitions/Keyword"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateKeywordAPIRequest $request)
    {
        $input = $request->all();

        /** @var Keyword $keyword */
        $keyword = $this->keywordRepository->findWithoutFail($id);

        if (empty($keyword)) {
            return $this->sendError('Keyword not found');
        }

        $keyword = $this->keywordRepository->update($input, $id);

        return $this->sendResponse($keyword->toArray(), 'Keyword updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/keywords/{id}",
     *      summary="Remove the specified Keyword from storage",
     *      tags={"Keyword"},
     *      description="Delete Keyword",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Keyword",
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
        /** @var Keyword $keyword */
        $keyword = $this->keywordRepository->findWithoutFail($id);

        if (empty($keyword)) {
            return $this->sendError('Keyword not found');
        }

        $keyword->delete();

        return $this->sendResponse($id, 'Keyword deleted successfully');
    }
}
