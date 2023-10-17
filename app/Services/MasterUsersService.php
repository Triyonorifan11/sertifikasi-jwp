<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Vinkla\Hashids\Facades\Hashids;
class MasterUsersService
{
    // Your service logic here
    public static function create($data)
    {
        $user = new User();
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->email_verified_at = isset($data['email_verified_at']) ? $data['email_verified_at']: null;
        $user->password = bcrypt($data['password']);
        $user->role_id = Hashids::decode($data['role_id'])[0];
        $user->active = $data['active'];
        $user->save();
        ActivityLogService::logMasterCreate('Users',$user);
        return $user;
    }

    // show all data
    public static function show()
    {
        $user = User::paginate(10);
        return $user;
    }

    // update data
    public static function update($data, $user)
    {
        $user->name = $data['name'];
        $user->username = $data['username'];
        $user->email = $data['email'];
        $user->email_verified_at = isset($data['email_verified_at']) ? $data['email_verified_at']: null;
        // CHECK if password is not empty
        if (!empty($data['password'])) {
            // set password
            $user->password = bcrypt($data['password']);
        }
        $user->role_id = Hashids::decode($data['role_id'])[0];
        $user->active = $data['active'];
        $user->save();
        ActivityLogService::logMasterUpdate('Users',$user);
        return $user;
    }

    // delete data
    public static function delete($user)
    {
        // CHECK auth user is not deleted
        if ($user->id == auth()->user()->id) {
            // throw error
            throw new \Exception('You cannot delete yourself');
        }
        $user->delete();
        ActivityLogService::logMasterDelete('Users',$user);
        return $user;
    }

}
