<?php

namespace App\Http\Controllers\Admin;

use App\Degree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDegreesRequest;
use App\Http\Requests\Admin\UpdateDegreesRequest;

class DegreesController extends Controller
{
    /**
     * Display a listing of Degree.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('degree_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('degree_delete')) {
                return abort(401);
            }
            $degrees = Degree::onlyTrashed()->get();
        } else {
            $degrees = Degree::all();
        }

        return view('admin.degrees.index', compact('degrees'));
    }

    /**
     * Show the form for creating new Degree.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('degree_create')) {
            return abort(401);
        }
        return view('admin.degrees.create');
    }

    /**
     * Store a newly created Degree in storage.
     *
     * @param  \App\Http\Requests\StoreDegreesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDegreesRequest $request)
    {
        if (! Gate::allows('degree_create')) {
            return abort(401);
        }
        $degree = Degree::create($request->all());



        return redirect()->route('admin.degrees.index');
    }


    /**
     * Show the form for editing Degree.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('degree_edit')) {
            return abort(401);
        }
        $degree = Degree::findOrFail($id);

        return view('admin.degrees.edit', compact('degree'));
    }

    /**
     * Update Degree in storage.
     *
     * @param  \App\Http\Requests\UpdateDegreesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDegreesRequest $request, $id)
    {
        if (! Gate::allows('degree_edit')) {
            return abort(401);
        }
        $degree = Degree::findOrFail($id);
        $degree->update($request->all());



        return redirect()->route('admin.degrees.index');
    }


    /**
     * Display Degree.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('degree_view')) {
            return abort(401);
        }
        $users = \App\User::where('degree_id', $id)->get();

        $degree = Degree::findOrFail($id);

        return view('admin.degrees.show', compact('degree', 'users'));
    }


    /**
     * Remove Degree from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('degree_delete')) {
            return abort(401);
        }
        $degree = Degree::findOrFail($id);
        $degree->delete();

        return redirect()->route('admin.degrees.index');
    }

    /**
     * Delete all selected Degree at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('degree_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Degree::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Degree from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('degree_delete')) {
            return abort(401);
        }
        $degree = Degree::onlyTrashed()->findOrFail($id);
        $degree->restore();

        return redirect()->route('admin.degrees.index');
    }

    /**
     * Permanently delete Degree from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('degree_delete')) {
            return abort(401);
        }
        $degree = Degree::onlyTrashed()->findOrFail($id);
        $degree->forceDelete();

        return redirect()->route('admin.degrees.index');
    }
}
