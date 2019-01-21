<?php

namespace App\Http\Controllers\Admin;

use App\Semester;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSemestersRequest;
use App\Http\Requests\Admin\UpdateSemestersRequest;

class SemestersController extends Controller
{
    /**
     * Display a listing of Semester.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('semester_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('semester_delete')) {
                return abort(401);
            }
            $semesters = Semester::onlyTrashed()->get();
        } else {
            $semesters = Semester::all();
        }

        return view('admin.semesters.index', compact('semesters'));
    }

    /**
     * Show the form for creating new Semester.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('semester_create')) {
            return abort(401);
        }
        return view('admin.semesters.create');
    }

    /**
     * Store a newly created Semester in storage.
     *
     * @param  \App\Http\Requests\StoreSemestersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSemestersRequest $request)
    {
        if (! Gate::allows('semester_create')) {
            return abort(401);
        }
        $semester = Semester::create($request->all());



        return redirect()->route('admin.semesters.index');
    }


    /**
     * Show the form for editing Semester.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('semester_edit')) {
            return abort(401);
        }
        $semester = Semester::findOrFail($id);

        return view('admin.semesters.edit', compact('semester'));
    }

    /**
     * Update Semester in storage.
     *
     * @param  \App\Http\Requests\UpdateSemestersRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSemestersRequest $request, $id)
    {
        if (! Gate::allows('semester_edit')) {
            return abort(401);
        }
        $semester = Semester::findOrFail($id);
        $semester->update($request->all());



        return redirect()->route('admin.semesters.index');
    }


    /**
     * Display Semester.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('semester_view')) {
            return abort(401);
        }
        $subjects = \App\Subject::where('semester_id', $id)->get();
        $marks = \App\Mark::where('semester_id', $id)->get();

        $semester = Semester::findOrFail($id);

        return view('admin.semesters.show', compact('semester', 'subjects', 'marks'));
    }


    /**
     * Remove Semester from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('semester_delete')) {
            return abort(401);
        }
        $semester = Semester::findOrFail($id);
        $semester->delete();

        return redirect()->route('admin.semesters.index');
    }

    /**
     * Delete all selected Semester at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('semester_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Semester::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Semester from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('semester_delete')) {
            return abort(401);
        }
        $semester = Semester::onlyTrashed()->findOrFail($id);
        $semester->restore();

        return redirect()->route('admin.semesters.index');
    }

    /**
     * Permanently delete Semester from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('semester_delete')) {
            return abort(401);
        }
        $semester = Semester::onlyTrashed()->findOrFail($id);
        $semester->forceDelete();

        return redirect()->route('admin.semesters.index');
    }
}
