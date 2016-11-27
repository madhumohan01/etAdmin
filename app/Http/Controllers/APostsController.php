<?php

namespace App\Http\Controllers;

use App\DataTables\APostsDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAPostsRequest;
use App\Http\Requests\UpdateAPostsRequest;
use App\Repositories\APostsRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class APostsController extends AppBaseController
{
    /** @var  APostsRepository */
    private $aPostsRepository;

    public function __construct(APostsRepository $aPostsRepo)
    {
        $this->aPostsRepository = $aPostsRepo;
    }

    /**
     * Display a listing of the APosts.
     *
     * @param APostsDataTable $aPostsDataTable
     * @return Response
     */
    public function index(APostsDataTable $aPostsDataTable)
    {
        return $aPostsDataTable->render('a_posts.index');
    }

    /**
     * Show the form for creating a new APosts.
     *
     * @return Response
     */
    public function create()
    {
        return view('a_posts.create');
    }

    /**
     * Store a newly created APosts in storage.
     *
     * @param CreateAPostsRequest $request
     *
     * @return Response
     */
    public function store(CreateAPostsRequest $request)
    {
        $input = $request->all();

        $aPosts = $this->aPostsRepository->create($input);

        Flash::success('A Posts saved successfully.');

        return redirect(route('aPosts.index'));
    }

    /**
     * Display the specified APosts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $aPosts = $this->aPostsRepository->findWithoutFail($id);

        if (empty($aPosts)) {
            Flash::error('A Posts not found');

            return redirect(route('aPosts.index'));
        }

        return view('a_posts.show')->with('aPosts', $aPosts);
    }

    /**
     * Show the form for editing the specified APosts.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $aPosts = $this->aPostsRepository->findWithoutFail($id);

        if (empty($aPosts)) {
            Flash::error('A Posts not found');

            return redirect(route('aPosts.index'));
        }

        return view('a_posts.edit')->with('aPosts', $aPosts);
    }

    /**
     * Update the specified APosts in storage.
     *
     * @param  int              $id
     * @param UpdateAPostsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAPostsRequest $request)
    {
        $aPosts = $this->aPostsRepository->findWithoutFail($id);

        if (empty($aPosts)) {
            Flash::error('A Posts not found');

            return redirect(route('aPosts.index'));
        }

        $aPosts = $this->aPostsRepository->update($request->all(), $id);

        Flash::success('A Posts updated successfully.');

        return redirect(route('aPosts.index'));
    }

    /**
     * Remove the specified APosts from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $aPosts = $this->aPostsRepository->findWithoutFail($id);

        if (empty($aPosts)) {
            Flash::error('A Posts not found');

            return redirect(route('aPosts.index'));
        }

        $this->aPostsRepository->delete($id);

        Flash::success('A Posts deleted successfully.');

        return redirect(route('aPosts.index'));
    }
}
