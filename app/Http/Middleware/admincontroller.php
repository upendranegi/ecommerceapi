<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class admincontroller extends Controller
{
    //
    public function checkadmin(Request $req){

     echo   $adminname=$req->adminid;
       echo  $adminpasw=$req->password;
                $ADMIN=DB::table('admin')->where('adminname',$adminname && 'adminpassword',$adminpasw)->exists();

                    $ADMIN;
                if(empty($ADMIN)){
                  

                        session()->put('adminuser', $adminname);
                        
                      return redirect('/admin/Dashborad');

                   
                }else{
                    return redirect('./admin/');
                }
// $seaso=session()->put('adminuser', $adminname);




    }

    public function Addadmin(){
        
    }
}
