<?php

namespace App\Http\Controllers;

use App\Parents;
use App\Student;
use App\Teacher;
use Facade\Ignition\Http\Controllers\StyleController;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\User;

class UserController extends BaseController
{

    public User $user;
    public Student $student;
    public Teacher $teacher;
    public Parents $parent;

    public function __construct(Student $student, Teacher $teacher, Parents $parent, User $user)
    {
        $this->user = $user;
        $this->student = $student;
        $this->teacher = $teacher;
        $this->parent = $parent ;
    }

    public function IdentifyUse( $data, $user)
    {
        switch ((int)$data['role']){
            case 2:
//                $user->teacher()->create([])// no call class teacher, base on relationship 1-n
                Teacher::create([
                    'user_id' => $user->id,
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                    'dateofbirth' => $data['dateofbirth'],
                    'current_address' => $data['current_address'],
                    'permanent_address' => $data['permanent_address'],

                ]);
                break;
            case 3:
                Parents::create([
                    'user_id' => $user->id,
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                    'dateofbirth' => $data['dateofbirth'],
                    'current_address' => $data['current_address'],
                    'permanent_address' => $data['permanent_address'],
                ]);
            case 4:

                Student::create([
                    'user_id' => $user->id,
                    'gender' => $data['gender'],
                    'phone' => $data['phone'],
                    'dateofbirth' => $data['dateofbirth'],
                    'current_address' => $data['current_address'],
                    'permanent_address' => $data['permanent_address'],

                ]);
                break;
            default:
                echo "Your favorite color is neither red, blue, nor green!";

        }
    }

    public function checkRoleUpdate(User $user){

        $checkRole = 1;
        $teacher = $user->teacher()->get();
        $student = $user->student()->get();
        $parent = $user->parent()->get();
        if($checkRole == $teacher->count()){
            return $teacher;
        }
        if($checkRole == $student->count()){
            return $student;
        }
        if($checkRole == $parent->count()){
            return $parent;
        }
    }



}
