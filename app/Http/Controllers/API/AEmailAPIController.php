<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateAEmailAPIRequest;
use App\Http\Requests\API\UpdateAEmailAPIRequest;
use App\Models\AEmail;
use App\Repositories\AEmailRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class AEmailController
 * @package App\Http\Controllers\API
 */

class AEmailAPIController extends AppBaseController
{
    /** @var  AEmailRepository */
    private $aEmailRepository;

    public function __construct(AEmailRepository $aEmailRepo)
    {
        $this->aEmailRepository = $aEmailRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/aEmails",
     *      summary="Get a listing of the AEmails.",
     *      tags={"AEmail"},
     *      description="Get all AEmails",
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
     *                  @SWG\Items(ref="#/definitions/AEmail")
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
        $this->aEmailRepository->pushCriteria(new RequestCriteria($request));
        $this->aEmailRepository->pushCriteria(new LimitOffsetCriteria($request));
        $aEmails = $this->aEmailRepository->all();

        return $this->sendResponse($aEmails->toArray(), 'A Emails retrieved successfully');
    }

    /**
     * @param CreateAEmailAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/aEmails",
     *      summary="Store a newly created AEmail in storage",
     *      tags={"AEmail"},
     *      description="Store AEmail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AEmail that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AEmail")
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
     *                  ref="#/definitions/AEmail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateAEmailAPIRequest $request)
    {
        $input = $request->all();

        $aEmails = $this->aEmailRepository->create($input);

        return $this->sendResponse($aEmails->toArray(), 'A Email saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/aEmails/{id}",
     *      summary="Display the specified AEmail",
     *      tags={"AEmail"},
     *      description="Get AEmail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AEmail",
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
     *                  ref="#/definitions/AEmail"
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
        /** @var AEmail $aEmail */
        $aEmail = $this->aEmailRepository->findWithoutFail($id);

        if (empty($aEmail)) {
            return $this->sendError('A Email not found');
        }

        return $this->sendResponse($aEmail->toArray(), 'A Email retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateAEmailAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/aEmails/{id}",
     *      summary="Update the specified AEmail in storage",
     *      tags={"AEmail"},
     *      description="Update AEmail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AEmail",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="AEmail that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/AEmail")
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
     *                  ref="#/definitions/AEmail"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateAEmailAPIRequest $request)
    {
        $input = $request->all();

        /** @var AEmail $aEmail */
        $aEmail = $this->aEmailRepository->findWithoutFail($id);

        if (empty($aEmail)) {
            return $this->sendError('A Email not found');
        }

        $aEmail = $this->aEmailRepository->update($input, $id);

        return $this->sendResponse($aEmail->toArray(), 'AEmail updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/aEmails/{id}",
     *      summary="Remove the specified AEmail from storage",
     *      tags={"AEmail"},
     *      description="Delete AEmail",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of AEmail",
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
        /** @var AEmail $aEmail */
        $aEmail = $this->aEmailRepository->findWithoutFail($id);

        if (empty($aEmail)) {
            return $this->sendError('A Email not found');
        }

        $aEmail->delete();

        return $this->sendResponse($id, 'A Email deleted successfully');
    }
}
