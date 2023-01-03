<?php

namespace App\Http\Controllers;

use App\Grade;
use App\Http\Requests\GradeRequest;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    public function index()
    {
        $grades = Grade::with('classes')->get();

        return view('backend.grades.index', compact('grades'));
    }
    public function show(){

    }

    public function create(){
        return view('backend.grades.create');
    }

    public function store(GradeRequest $request){
        $data = $request->all();

        $grade = new Grade();
        $grade->name = $data['name_grade'];
        $grade->note = $data['note_grade'];
        $grade->save();

        return redirect()->route('grades.create');
    }

    public function edit(){

    }

    public function update(){

    }

    public function destroy(){

    }
}
