<?php

namespace App\Http\Controllers;

use App\DataTables\UnsubscribeListDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateUnsubscribeListRequest;
use App\Http\Requests\UpdateUnsubscribeListRequest;
use App\Repositories\UnsubscribeListRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class UnsubscribeListController extends AppBaseController
{
    /** @var  UnsubscribeListRepository */
    private $unsubscribeListRepository;

    public function __construct(UnsubscribeListRepository $unsubscribeListRepo)
    {
        $this->unsubscribeListRepository = $unsubscribeListRepo;
    }

    /**
     * Display a listing of the UnsubscribeList.
     *
     * @param UnsubscribeListDataTable $unsubscribeListDataTable
     * @return Response
     */
    public function index(UnsubscribeListDataTable $unsubscribeListDataTable)
    {
        return $unsubscribeListDataTable->render('unsubscribe_lists.index');
    }

    /**
     * Show the form for creating a new UnsubscribeList.
     *
     * @return Response
     */
    public function create()
    {
        return view('unsubscribe_lists.create');
    }

    /**
     * Store a newly created UnsubscribeList in storage.
     *
     * @param CreateUnsubscribeListRequest $request
     *
     * @return Response
     */
    public function store(CreateUnsubscribeListRequest $request)
    {
        $input = $request->all();

        $unsubscribeList = $this->unsubscribeListRepository->create($input);

        Flash::success('Unsubscribe List saved successfully.');

        return redirect(route('unsubscribeLists.index'));
    }

    /**
     * Display the specified UnsubscribeList.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $unsubscribeList = $this->unsubscribeListRepository->findWithoutFail($id);

        if (empty($unsubscribeList)) {
            Flash::error('Unsubscribe List not found');

            return redirect(route('unsubscribeLists.index'));
        }

        return view('unsubscribe_lists.show')->with('unsubscribeList', $unsubscribeList);
    }

    /**
     * Show the form for editing the specified UnsubscribeList.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $unsubscribeList = $this->unsubscribeListRepository->findWithoutFail($id);

        if (empty($unsubscribeList)) {
            Flash::error('Unsubscribe List not found');

            return redirect(route('unsubscribeLists.index'));
        }

        return view('unsubscribe_lists.edit')->with('unsubscribeList', $unsubscribeList);
    }

    /**
     * Update the specified UnsubscribeList in storage.
     *
     * @param  int              $id
     * @param UpdateUnsubscribeListRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUnsubscribeListRequest $request)
    {
        $unsubscribeList = $this->unsubscribeListRepository->findWithoutFail($id);

        if (empty($unsubscribeList)) {
            Flash::error('Unsubscribe List not found');

            return redirect(route('unsubscribeLists.index'));
        }

        $unsubscribeList = $this->unsubscribeListRepository->update($request->all(), $id);

        Flash::success('Unsubscribe List updated successfully.');

        return redirect(route('unsubscribeLists.index'));
    }

    /**
     * Remove the specified UnsubscribeList from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $unsubscribeList = $this->unsubscribeListRepository->findWithoutFail($id);

        if (empty($unsubscribeList)) {
            Flash::error('Unsubscribe List not found');

            return redirect(route('unsubscribeLists.index'));
        }

        $this->unsubscribeListRepository->delete($id);

        Flash::success('Unsubscribe List deleted successfully.');

        return redirect(route('unsubscribeLists.index'));
    }
}
