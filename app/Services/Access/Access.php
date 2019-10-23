<?php

namespace App\Services\Access;

use App\Models\Content\Content;
use App\Models\Settings\Settings;
use Illuminate\Contracts\Auth\Authenticatable;
use App\Repositories\Category\EloquentCategoryRepository;
use App\Models\Booking\Booking;
use App\Models\Department\Department;
use App\Models\Backup\Backup;
use Cache;
use Artisan;
use Storage;

/**
 * Class Access.
 */
class Access
{
    /**
     * Get the currently authenticated user or null.
     */
public function user()
    {
        return auth()->user();
    }

    /**
     * Return if the current session user is a guest or not.
     *
     * @return mixed
     */
    public function guest()
    {
        return auth()->guest();
    }

    /**
     * @return mixed
     */
    public function logout()
    {
        return auth()->logout();
    }

    /**
     * Get the currently authenticated user's id.
     *
     * @return mixed
     */
    public function id()
    {
        return auth()->id();
    }

    /**
     * @param Authenticatable $user
     * @param bool            $remember
     */
    public function login(Authenticatable $user, $remember = false)
    {
        return auth()->login($user, $remember);
    }

    /**
     * @param $id
     *
     * @return mixed
     */
    public function loginUsingId($id)
    {
        return auth()->loginUsingId($id);
    }

    /**
     * Checks if the current user has a Role by its name or id.
     *
     * @param string $role Role name.
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if ($user = $this->user()) {
            return $user->hasRole($role);
        }

        return false;
    }

    /**
     * Checks if the user has either one or more, or all of an array of roles.
     *
     * @param  $roles
     * @param bool $needsAll
     *
     * @return bool
     */
    public function hasRoles($roles, $needsAll = false)
    {
        if ($user = $this->user()) {
            return $user->hasRoles($roles, $needsAll);
        }

        return false;
    }

    /**
     * Check if the current user has a permission by its name or id.
     *
     * @param string $permission Permission name or id.
     *
     * @return bool
     */
    public function allow($permission)
    {
        if ($user = $this->user()) {
            return $user->allow($permission);
        }

        return false;
    }

    /**
     * Check an array of permissions and whether or not all are required to continue.
     *
     * @param  $permissions
     * @param  $needsAll
     *
     * @return bool
     */
    public function allowMultiple($permissions, $needsAll = false)
    {
        if ($user = $this->user()) {
            return $user->allowMultiple($permissions, $needsAll);
        }

        return false;
    }

    /**
     * @param  $permission
     *
     * @return bool
     */
    public function hasPermission($permission)
    {
        return $this->allow($permission);
    }

    /**
     * @param  $permissions
     * @param  $needsAll
     *
     * @return bool
     */
    public function hasPermissions($permissions, $needsAll = false)
    {
        return $this->allowMultiple($permissions, $needsAll);
    }

    public function getPermissionByTier($userLevel)
    {
        $categoryRepo = new EloquentCategoryRepository;

        return $categoryRepo->getPermissionByTier($userLevel);
    }

    public function getBlock($key = null)
    {
        if($key)
        {
            return Content::where('data_key', $key)->pluck('content')->first();
        }

        return '';
    }

    /**
     * Get Setting
     * 
     * @param string $key
     * @return object
     */
    public function getSetting($key = null)
    {
        if($key)
        {
            return Settings::where('data_key', $key)->pluck('value')->first();
        }

        return '';
    }

    public function getQueueNumber()
    {
        $today      = date('Y-m-d');
        $department = $this->getCurrentDepartment();

        if(isset($department))
        {
            $lastBooking = Booking::whereDate('created_at', $today)
                ->where('department_id', $department->id)
                ->orderBy('id', 'desc')
                ->first();
        }
        else
        {
            $lastBooking = Booking::where('booking_date', $today)
                ->orderBy('id', 'desc')
                ->first();   
        }

        if(isset($lastBooking))
        {
            return $lastBooking->queue_number + 1;
        }

        return 1;
    }

    public function getBookingSurgeries($surgeries)
    {
        $surgeryData = [];

        if(isset($surgeries) && count($surgeries))
        {
            foreach($surgeries as $surgery)
            {
                $surgeryData[] = $surgery->surgery->title;
            }
        }

        if(count($surgeryData))
        {
            return implode(', ', $surgeryData);
        }

        return '-';
    }

    public function getUserDepartment($user = null)
    {
        $user = $user ? $user : $this->user();

        if(isset($user->department_id))
        {
            $deparment = Department::where('id', $user->department_id)->first();

            if(isset($deparment))
            {
                return $deparment->name;
            }
        }

        return '';
    }

    public function getCurrentDepartment()
    {
        $user = $this->user();

        if(isset($user->department_id))
        {
            $deparment = Department::where('id', $user->department_id)->first();

            if(isset($deparment))
            {
                return $deparment;
            }
        }

        return false;
    }

    public function getDepartmentNumber()
    {
        $department = $this->getCurrentDepartment();
        
        if(isset($department))
        {
            $lastBooking = Booking::where('department_id', $department->id)
                ->orderBy('id', 'desc')
                ->first();

            if(isset($lastBooking))
            {
                return $lastBooking->department_number + 1;
            }
        }

        return 1;
    }

    public function takeBackup()
    {
        $date = (string) date('Y-m-d').'11';

        if(Cache::has($date))
        {
            return;
        }

        Backup::create([
            'user_id'       => 1,
            'file_title'    => date('YmdHis'),
            'description'   => 'Backup FILE Created successfully'
        ]);
        //$files =  Storage::allFiles();
        Artisan::call('backup:mysql-dump');
        Cache::put($date, 1, 1500);
        return;
    }
}
