<?php

namespace App\Http\Controllers\Api\V1;

use App\Degree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDegreesRequest;
use App\Http\Requests\Admin\UpdateDegreesRequest;

class DegreesController extends Controller
{
    public function index()
    {
        return Degree::all();
    }

    public function show($id)
    {
        return Degree::findOrFail($id);
    }

    public function update(UpdateDegreesRequest $request, $id)
    {
        $degree = Degree::findOrFail($id);
        $degree->update($request->all());
        

        return $degree;
    }

    public function store(StoreDegreesRequest $request)
    {
        $degree = Degree::create($request->all());
        

        return $degree;
    }

    public function destroy($id)
    {
        $degree = Degree::findOrFail($id);
        $degree->delete();
        return '';
    }
}
