<?php

namespace App\Http\Controllers\Api\V1;

use App\Mark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMarksRequest;
use App\Http\Requests\Admin\UpdateMarksRequest;

class MarksController extends Controller
{
    public function index()
    {
        return Mark::all();
    }

    public function show($id)
    {
        return Mark::findOrFail($id);
    }

    public function update(UpdateMarksRequest $request, $id)
    {
        $mark = Mark::findOrFail($id);
        $mark->update($request->all());
        

        return $mark;
    }

    public function store(StoreMarksRequest $request)
    {
        $mark = Mark::create($request->all());
        

        return $mark;
    }

    public function destroy($id)
    {
        $mark = Mark::findOrFail($id);
        $mark->delete();
        return '';
    }
}
