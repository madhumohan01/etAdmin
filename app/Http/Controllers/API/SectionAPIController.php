<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateSectionAPIRequest;
use App\Http\Requests\API\UpdateSectionAPIRequest;
use App\Models\Section;
use App\Repositories\SectionRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class SectionController
 * @package App\Http\Controllers\API
 */

class SectionAPIController extends AppBaseController
{
    /** @var  SectionRepository */
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepo)
    {
        $this->sectionRepository = $sectionRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/sections",
     *      summary="Get a listing of the Sections.",
     *      tags={"Section"},
     *      description="Get all Sections",
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
     *                  @SWG\Items(ref="#/definitions/Section")
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
        $this->sectionRepository->pushCriteria(new RequestCriteria($request));
        $this->sectionRepository->pushCriteria(new LimitOffsetCriteria($request));
        $sections = $this->sectionRepository->all();

        return $this->sendResponse($sections->toArray(), 'Sections retrieved successfully');
    }

    /**
     * @param CreateSectionAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/sections",
     *      summary="Store a newly created Section in storage",
     *      tags={"Section"},
     *      description="Store Section",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Section that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Section")
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
     *                  ref="#/definitions/Section"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateSectionAPIRequest $request)
    {
        $input = $request->all();

        $sections = $this->sectionRepository->create($input);

        return $this->sendResponse($sections->toArray(), 'Section saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/sections/{id}",
     *      summary="Display the specified Section",
     *      tags={"Section"},
     *      description="Get Section",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Section",
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
     *                  ref="#/definitions/Section"
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
        /** @var Section $section */
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            return $this->sendError('Section not found');
        }

        return $this->sendResponse($section->toArray(), 'Section retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateSectionAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/sections/{id}",
     *      summary="Update the specified Section in storage",
     *      tags={"Section"},
     *      description="Update Section",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Section",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Section that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Section")
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
     *                  ref="#/definitions/Section"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateSectionAPIRequest $request)
    {
        $input = $request->all();

        /** @var Section $section */
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            return $this->sendError('Section not found');
        }

        $section = $this->sectionRepository->update($input, $id);

        return $this->sendResponse($section->toArray(), 'Section updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/sections/{id}",
     *      summary="Remove the specified Section from storage",
     *      tags={"Section"},
     *      description="Delete Section",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Section",
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
        /** @var Section $section */
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            return $this->sendError('Section not found');
        }

        $section->delete();

        return $this->sendResponse($id, 'Section deleted successfully');
    }
}
