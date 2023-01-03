<?php

namespace App\Http\Controllers;

use App\Parents;
use App\Student;
use App\Teacher;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\UserController;

class RoleAssign extends Controller
{
    public UserController $userController;

    public function __construct(UserController $userController)
    {
        $this->userController = $userController;
    }

    public function index()
    {

        $users = User::with('roles')->latest()->paginate(10);

        return view('backend.assignrole.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::latest()->get();

        return view('backend.assignrole.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|string|max:255',
            'email'     => 'required|string|email|max:255|unique:users',
            'password'  => 'required|string|min:8',
            'dateofbirth' => 'required|date',
            'phone' => 'required',
            'gender' => ['required', Rule::in(['male', 'female', 'other'])],
            'current_address' => 'required|string|max:255',
            'permanent_address' => 'nullable|string|max:255',
            'role' => 'required'

        ]);

        $data = $request->all();
        $user = User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'password'  => Hash::make($data['password'])
        ]);
        $user->assignRole($request->role);
        $this->userController->IdentifyUse($data, $user);

        return redirect()->route('assignrole.index');
    }

    public function edit($id)
    {
        $user = User::with('roles')->findOrFail($id);
        $relationships = $this->userController->checkRoleUpdate($user);
        $roles = Role::latest()->get();


        return view('backend.assignrole.edit', compact('user','roles', 'relationships'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$id
        ]);

        $data = $request->all();
        $user = User::findOrFail($id);
//        $checkIsChangeRole = $this->userController->checkRoleUpdate($user);

//        foreach ($checkIsChangeRole as $role){
//            if($request->role == chec)
//        }
        $this->userController->IdentifyUse($data, $user);
        $user->syncRoles($request->selectedrole);

        return redirect()->route('assignrole.index');
    }

    // NOT DONE
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // $user->removeRole('writer');
        // $user->syncRoles(['writer', 'admin']);

        // if ($user->delete()) {

        //     if($user->profile_picture != 'avatar.png') {

        //         $image_path = public_path() . '/images/profile/' . $user->profile_picture;

        //         if (is_file($image_path) && file_exists($image_path)) {

        //             unlink($image_path);
        //         }
        //     }

        // }

        return back();
    }
}
