<?php

namespace App\Http\Controllers;

use App\DataTables\SectionDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateSectionRequest;
use App\Http\Requests\UpdateSectionRequest;
use App\Repositories\SectionRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;

class SectionController extends AppBaseController
{
    /** @var  SectionRepository */
    private $sectionRepository;

    public function __construct(SectionRepository $sectionRepo)
    {
        $this->sectionRepository = $sectionRepo;
    }

    /**
     * Display a listing of the Section.
     *
     * @param SectionDataTable $sectionDataTable
     * @return Response
     */
    public function index(SectionDataTable $sectionDataTable)
    {
        return $sectionDataTable->render('sections.index');
    }

    /**
     * Show the form for creating a new Section.
     *
     * @return Response
     */
    public function create()
    {
        return view('sections.create');
    }

    /**
     * Store a newly created Section in storage.
     *
     * @param CreateSectionRequest $request
     *
     * @return Response
     */
    public function store(CreateSectionRequest $request)
    {
        $input = $request->all();

        $section = $this->sectionRepository->create($input);

        Flash::success('Section saved successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Display the specified Section.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        return view('sections.show')->with('section', $section);
    }

    /**
     * Show the form for editing the specified Section.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        return view('sections.edit')->with('section', $section);
    }

    /**
     * Update the specified Section in storage.
     *
     * @param  int              $id
     * @param UpdateSectionRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSectionRequest $request)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        $section = $this->sectionRepository->update($request->all(), $id);

        Flash::success('Section updated successfully.');

        return redirect(route('sections.index'));
    }

    /**
     * Remove the specified Section from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $section = $this->sectionRepository->findWithoutFail($id);

        if (empty($section)) {
            Flash::error('Section not found');

            return redirect(route('sections.index'));
        }

        $this->sectionRepository->delete($id);

        Flash::success('Section deleted successfully.');

        return redirect(route('sections.index'));
    }
}
