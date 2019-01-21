<?php

namespace App\Http\Controllers\Admin;

use App\Mark;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMarksRequest;
use App\Http\Requests\Admin\UpdateMarksRequest;

class MarksController extends Controller
{
    /**
     * Display a listing of Mark.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('mark_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('mark_delete')) {
                return abort(401);
            }
            $marks = Mark::onlyTrashed()->get();
        } else {
            $marks = Mark::all();
        }

        return view('admin.marks.index', compact('marks'));
    }

    /**
     * Show the form for creating new Mark.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('mark_create')) {
            return abort(401);
        }

        $users = \App\User::where('role_id', 2)->get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $semesters = \App\Semester::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $subjects = \App\Subject::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        return view('admin.marks.create', compact('users', 'semesters', 'subjects'));
    }

    /**
     * Store a newly created Mark in storage.
     *
     * @param  \App\Http\Requests\StoreMarksRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMarksRequest $request)
    {
        if (! Gate::allows('mark_create')) {
            return abort(401);
        }
        $mark = Mark::create($request->all());



        return redirect()->route('admin.marks.index');
    }


    /**
     * Show the form for editing Mark.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('mark_edit')) {
            return abort(401);
        }

        $users = \App\User::where('role_id', 2)->get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $semesters = \App\Semester::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');
        $subjects = \App\Subject::get()->pluck('name', 'id')->prepend(trans('quickadmin.qa_please_select'), '');

        $mark = Mark::findOrFail($id);

        return view('admin.marks.edit', compact('mark', 'users', 'semesters', 'subjects'));
    }

    /**
     * Update Mark in storage.
     *
     * @param  \App\Http\Requests\UpdateMarksRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMarksRequest $request, $id)
    {
        if (! Gate::allows('mark_edit')) {
            return abort(401);
        }
        $mark = Mark::findOrFail($id);
        $mark->update($request->all());



        return redirect()->route('admin.marks.index');
    }


    /**
     * Display Mark.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('mark_view')) {
            return abort(401);
        }
        $mark = Mark::findOrFail($id);

        return view('admin.marks.show', compact('mark'));
    }


    /**
     * Remove Mark from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('mark_delete')) {
            return abort(401);
        }
        $mark = Mark::findOrFail($id);
        $mark->delete();

        return redirect()->route('admin.marks.index');
    }

    /**
     * Delete all selected Mark at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('mark_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Mark::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Mark from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('mark_delete')) {
            return abort(401);
        }
        $mark = Mark::onlyTrashed()->findOrFail($id);
        $mark->restore();

        return redirect()->route('admin.marks.index');
    }

    /**
     * Permanently delete Mark from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('mark_delete')) {
            return abort(401);
        }
        $mark = Mark::onlyTrashed()->findOrFail($id);
        $mark->forceDelete();

        return redirect()->route('admin.marks.index');
    }
}
