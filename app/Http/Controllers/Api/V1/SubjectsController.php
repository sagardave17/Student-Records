<?php

namespace App\Http\Controllers\Api\V1;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSubjectsRequest;
use App\Http\Requests\Admin\UpdateSubjectsRequest;

class SubjectsController extends Controller
{
    public function index()
    {
        return Subject::all();
    }

    public function show($id)
    {
        return Subject::findOrFail($id);
    }

    public function update(UpdateSubjectsRequest $request, $id)
    {
        $subject = Subject::findOrFail($id);
        $subject->update($request->all());
        

        return $subject;
    }

    public function store(StoreSubjectsRequest $request)
    {
        $subject = Subject::create($request->all());
        

        return $subject;
    }

    public function destroy($id)
    {
        $subject = Subject::findOrFail($id);
        $subject->delete();
        return '';
    }
}
