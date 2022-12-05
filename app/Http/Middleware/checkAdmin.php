<?php

namespace App\Http\Middleware;

use App\Models\Roles;
use Closure;
use Illuminate\Support\Facades\Auth;

class checkAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::user()->role->role == "Admin"){
            return $next($request);
        }
        else{
            return redirect()->route('dashboard');
        }
        // $id = Auth::user()->id_role;
        // $role = Roles::select('role')->find($id);
        // foreach($role as $row){
        //     if($role->role == "Admin"){
        //         return $next($request);
        //     }
        //     else{
        //         return redirect()->route('dashboard');
        //     }
        // }
    }
}
