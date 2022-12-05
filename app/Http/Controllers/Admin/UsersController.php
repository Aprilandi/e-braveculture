<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Levels;
use App\Models\Roles;
use App\Models\User;
use App\Models\UserStatus;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index() {
        $user = User::orderBy('id_role', 'asc')->get();
        $role = Roles::get();
        return view('admin/user', ['user' => $user, 'role' => $role, 'page' => 'Users'])->with('users', 'active');
    }

    public function store(Request $request) {
        // dd($request->all());

        if($request->file('txtAvatar')) {
            $uploadedFile = $request->file('txtAvatar');
            $extension = '.'.$uploadedFile->getClientOriginalExtension();
            $filename  = "avatar_".$request->txtUsername.$extension;
            $uploadedFile->move(base_path('public/images/avatar/'), $filename);

            $user = User::create([
                'name' => $request->txtName,
                'avatar' => $filename,
                'username' => $request->txtUsername,
                'email' => $request->txtEmail,
                'id_role' => $request->txtRole,
                'password' => bcrypt($request->txtPassword),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

            $userStatus = UserStatus::create([
                'id_user' => $user->id_user,
                'id_level' => Levels::orderBy('tier_level', 'asc')->first()->id_level,
                'experience_points' => '0',
                'redeemable_points' => '0',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }

        return redirect()->route('user.index')->with('insert', 'Data Berhasil Ditambah');
    }

    public function update(Request $request, $id){
        // dd($request);
        if($request->file('txtedAvatar')) {
            $uploadedFile = $request->file('txtedAvatar');
            $extension = '.'.$uploadedFile->getClientOriginalExtension();
            $filename  = "avatar_".$request->txtUsername.$extension;
            $uploadedFile->move(base_path('public/images/avatar/'), $filename);

            $user = User::where('id_user', $id)->update([
                'name' => $request->txtedName,
                'avatar' => $filename,
                'username' => $request->txtedUsername,
                'email' => $request->txtedEmail,
                'id_role' => $request->txtedRole,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        else{
            $user = User::where('id_user', $id)->update([
                'name' => $request->txtedName,
                'username' => $request->txtedUsername,
                'email' => $request->txtedEmail,
                'id_role' => $request->txtedRole,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
        if(isset($request->txtedPassword)){
            $user = User::where('id_user', $id)->update([
                'password' => bcrypt($request->txtedPassword),
            ]);
        }

        return redirect()->route('user.index')->with('update', 'Data Berhasil Diubah');
    }

    public function destroy($id) {
        User::where('id_user', $id)->delete();

        return redirect()->route('user.index')->with('delete', 'Data Berhasil Dihapus');
    }

    public function rolestore(Request $request) {
        // dd($request->all());

        $role = Roles::create([
            'role' => $request->txtRole,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('user.index')->with('insert', 'Data Berhasil Ditambah');
    }

    public function roleupdate(Request $request, $id){
        // dd($request);
        $role = Roles::where('id_role', $id)->update([
            'role' => $request->txtedRole,
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        ]);

        return redirect()->route('user.index')->with('update', 'Data Berhasil Diubah');
    }

    public function roledestroy($id) {
        Roles::where('id_role', $id)->delete();

        return redirect()->route('user.index')->with('delete', 'Data Berhasil Dihapus');
    }
}
