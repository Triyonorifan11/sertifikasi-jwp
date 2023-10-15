<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Http\Requests\StoreUnitRequest;
use App\Http\Requests\UpdateUnitRequest;
use App\Services\MasterUnitsService;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $data = [
            'units' => MasterUnitsService::show(),
            'title' => 'Master Unit'
        ];
        return view('unit.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = [
            'title' => 'Form Master Unit',
            'action' => 'New Data',
            'unit' => [],
        ];
        return view('unit.form', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUnitRequest $request)
    {
        $unit = MasterUnitsService::create($request->all());
        return redirect()->route('unit.index')->with('success', 'Unit created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Unit $unit)
    {
         //
         $data = [
            'title' => 'Form Edit Master Category',
            'action' => 'Edit Data',
            'unit' => $unit,
        ];
        return view('unit.form', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUnitRequest $request, Unit $unit)
    {
        //
        $unit = MasterUnitsService::update($request->all(), $unit);
        return redirect()->route('unit.index')->with('success', 'Unit updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Unit $unit)
    {
        //
        $unit = MasterUnitsService::delete($unit);
        //parent::responseAPI($unit, 'Unit deleted successfully', OK);
        return redirect()->route('unit.index')->with('success', 'Unit deleted successfully');
    }
}
