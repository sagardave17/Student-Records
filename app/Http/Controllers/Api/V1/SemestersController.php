<?php

namespace App\Http\Controllers\Api\V1;

use App\Semester;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreSemestersRequest;
use App\Http\Requests\Admin\UpdateSemestersRequest;

class SemestersController extends Controller
{
    public function index()
    {
        return Semester::all();
    }

    public function show($id)
    {
        return Semester::findOrFail($id);
    }

    public function update(UpdateSemestersRequest $request, $id)
    {
        $semester = Semester::findOrFail($id);
        $semester->update($request->all());
        

        return $semester;
    }

    public function store(StoreSemestersRequest $request)
    {
        $semester = Semester::create($request->all());
        

        return $semester;
    }

    public function destroy($id)
    {
        $semester = Semester::findOrFail($id);
        $semester->delete();
        return '';
    }
}
