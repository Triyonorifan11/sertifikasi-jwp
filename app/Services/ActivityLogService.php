<?php

namespace App\Services;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;
class ActivityLogService
{
    // Your service logic here
    private static function log($subject,$description,$data)
    {
        ActivityLog::create([
            'subject' => $subject,
            'activity' => $description,
            'properties' => $data,
            'user_id' => auth()->user()->id,
        ]);
    }

    public static function logMasterCreate($object,$data)
    {
        $subject = "Master Data";
        $description = "Create ".$object;
        self::log($subject,$description,$data);
    }

    public static function logMasterUpdate($object,$data)
    {
        $subject = "Master Data";
        $description = "Update ".$object;
        self::log($subject,$description,$data);
    }

    public static function logMasterDelete($object,$data)
    {
        $subject = "Master Data";
        $description = "Delete ".$object;
        self::log($subject,$description,$data);
    }

}
