<?php

namespace App\Http\Controllers\Admin;

use App\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubjectsRequest;
use App\Http\Requests\Admin\UpdateSubjectsRequest;

class SubjectsController extends Controller
{
    /**
     * Display a listing of Subject.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('subject_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('subject_delete')) {
                return abort(401);
            }
            $subjects = Subject::onlyTrashed()->get();
        } else {
            $subjects = Subject::all();
        }

        return view('admin.subjects.index', compact('subjects'));
    }

    /**
     * Show the form for creating new Subject.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('subject_create')) {
            return abort(401);
        }

        $semesters = \App\Semester::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.subjects.create', compact('semesters'));
    }

    /**
     * Store a newly created Subject in storage.
     *
     * @param  \App\Http\Requests\StoreSubjectsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSubjectsRequest $request)
    {
        if (! Gate::allows('subject_create')) {
            return abort(401);
        }
        $subject = Subject::create($request->all());



        return redirect()->route('admin.subjects.index');
    }


    /**
     * Show the form for editing Subject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('subject_edit')) {
            return abort(401);
        }

        $semesters = \App\Semester::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $subject = Subject::findOrFail($id);

        return view('admin.subjects.edit', compact('subject', 'semesters'));
    }

    /**
     * Update Subject in storage.
     *
     * @param  \App\Http\Requests\UpdateSubjectsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSubjectsRequest $request, $id)
    {
        if (! Gate::allows('subject_edit')) {
            return abort(401);
        }
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());



        return redirect()->route('admin.subjects.index');
    }


    /**
     * Display Subject.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('subject_view')) {
            return abort(401);
        }

        $semesters = \App\Semester::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');$marks = \App\Mark::where('subject_id', $id)->get();

        $subject = Subject::findOrFail($id);

        return view('admin.subjects.show', compact('subject', 'marks'));
    }


    /**
     * Remove Subject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('subject_delete')) {
            return abort(401);
        }
        $subject = Subject::findOrFail($id);
        $subject->delete();

        return redirect()->route('admin.subjects.index');
    }

    /**
     * Delete all selected Subject at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('subject_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Subject::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Subject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('subject_delete')) {
            return abort(401);
        }
        $subject = Subject::onlyTrashed()->findOrFail($id);
        $subject->restore();

        return redirect()->route('admin.subjects.index');
    }

    /**
     * Permanently delete Subject from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('subject_delete')) {
            return abort(401);
        }
        $subject = Subject::onlyTrashed()->findOrFail($id);
        $subject->forceDelete();

        return redirect()->route('admin.subjects.index');
    }
}
