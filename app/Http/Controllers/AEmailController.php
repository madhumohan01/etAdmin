<?php

namespace App\Http\Controllers;

use App\DataTables\AEmailDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateAEmailRequest;
use App\Http\Requests\UpdateAEmailRequest;
use App\Repositories\AEmailRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class AEmailController extends AppBaseController
{
    /** @var  AEmailRepository */
    private $aEmailRepository;

    public function __construct(AEmailRepository $aEmailRepo)
    {
        $this->aEmailRepository = $aEmailRepo;
    }

    /**
     * Display a listing of the AEmail.
     *
     * @param AEmailDataTable $aEmailDataTable
     * @return Response
     */
    public function index(AEmailDataTable $aEmailDataTable)
    {
        return $aEmailDataTable->render('a_emails.index');
    }

    /**
     * Show the form for creating a new AEmail.
     *
     * @return Response
     */
    public function create()
    {
        return view('a_emails.create');
    }

    /**
     * Store a newly created AEmail in storage.
     *
     * @param CreateAEmailRequest $request
     *
     * @return Response
     */
    public function store(CreateAEmailRequest $request)
    {
        $input = $request->all();

        $aEmail = $this->aEmailRepository->create($input);

        Flash::success('A Email saved successfully.');

        return redirect(route('aEmails.index'));
    }

    /**
     * Display the specified AEmail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $aEmail = $this->aEmailRepository->findWithoutFail($id);

        if (empty($aEmail)) {
            Flash::error('A Email not found');

            return redirect(route('aEmails.index'));
        }

        return view('a_emails.show')->with('aEmail', $aEmail);
    }

    /**
     * Show the form for editing the specified AEmail.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $aEmail = $this->aEmailRepository->findWithoutFail($id);

        if (empty($aEmail)) {
            Flash::error('A Email not found');

            return redirect(route('aEmails.index'));
        }

        return view('a_emails.edit')->with('aEmail', $aEmail);
    }

    /**
     * Update the specified AEmail in storage.
     *
     * @param  int              $id
     * @param UpdateAEmailRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateAEmailRequest $request)
    {
        $aEmail = $this->aEmailRepository->findWithoutFail($id);

        if (empty($aEmail)) {
            Flash::error('A Email not found');

            return redirect(route('aEmails.index'));
        }

        $aEmail = $this->aEmailRepository->update($request->all(), $id);

        Flash::success('A Email updated successfully.');

        return redirect(route('aEmails.index'));
    }

    /**
     * Remove the specified AEmail from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $aEmail = $this->aEmailRepository->findWithoutFail($id);

        if (empty($aEmail)) {
            Flash::error('A Email not found');

            return redirect(route('aEmails.index'));
        }

        $this->aEmailRepository->delete($id);

        Flash::success('A Email deleted successfully.');

        return redirect(route('aEmails.index'));
    }
}
