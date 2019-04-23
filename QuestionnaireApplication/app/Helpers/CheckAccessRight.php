<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\ApplicationAccess;
use App\UserAccess;

class CheckAccessRight
{
    public function checkAccessRight($url)
    {
        $access = false;
        $url = $this->reformatUrl($url);
        $applicationaccesses = $this->applicationAccessToArray();
        $applicationaccessespageurls = array_column($applicationaccesses, 'pageurl');
        $urlid = array_search($url, $applicationaccessespageurls);
        if($urlid !== FALSE) {
            $user = Auth::user();
            var_dump(Auth::user());
            if($user != null) {
                //$useraccess = UserAccess::where('usertypeid', '=', $usertypeid);
                $useraccess = UserAccess::where([
                    ['usertypeid', '=', $usertypeid],
                    ['pageurl', '=', $applicationaccessespageurls[$urlid]]
                ]);
                    var_dump($useraccess);
             
                if(count($useraccess) > 0) {
                    $access = true;
                } 
            }
            //  
            // ->where([
            //     ['rowstate', '<>', 'Ready'], 
            //     [DB::raw('DATE_FORMAT(due_date, "%d-%m-%y")'), '<', $today_]
            //  ]);
            // $usertypeid = $user->usertypeid;
            // $useraccess = UserAccess::where('usertypeid', '=', $usertypeid);
            // var_dump($usertypeid);
            // var_dump($useraccess);
        } else {
            $access = true;
        }
        return $access;
    }

    public function applicationAccessToArray()
    {
        $applicationaccess = array();
        foreach(ApplicationAccess::all() as $access) {
            $applicationaccess[] = array(
                            'id' => $access->id,
                            'pageurl' => $access->pageurl
                        );
        }
        return $applicationaccess;
    }

    public function reformatUrl($url)
    {
        $applicationurl = str_replace('http://localhost', '', url('/'));
        $url = str_replace($applicationurl, '', $url);
        //remove id id edit
        return $url;
    }
}