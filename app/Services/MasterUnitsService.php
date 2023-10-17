<?php

namespace App\Services;

use App\Models\Unit;
use Illuminate\Support\Facades\Log;

class MasterUnitsService
{
    // Your service logic here
    public static function create($data)
    {
        $unit = new Unit();
        $unit->unit_name = $data['unit_name'];
        $unit->save();
        ActivityLogService::logMasterCreate('Unit',$unit);
        return $unit;
    }

    // show all data
    public static function show()
    {
        $units = Unit::paginate(10);
        return $units;
    }

    // edit data
    public static function select($id)
    {
        return Unit::find($id);
    }

    // update data
    public static function update($data, $unit)
    {
        $unit->unit_name = $data['unit_name'];
        $unit->save();
        ActivityLogService::logMasterUpdate('Unit',$unit);
        return $unit;
    }

    // delete data
    public static function delete($unit)
    {
        $unit->delete();
        ActivityLogService::logMasterDelete('Unit',$unit);
        return $unit;
    }


}
