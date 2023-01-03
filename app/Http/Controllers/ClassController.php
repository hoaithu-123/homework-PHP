<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Grade;
use App\Http\Requests\ClassRequest;
use App\Repositories\GradeRepository;
use App\Repositories\TeacherRepository;
use App\Student;
use App\Subject;
use App\Teacher;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $teacherRepository;
    protected $gradeRepository;
    protected $studentRepository;
    protected $subjectRepository;

    public function  __construct(TeacherRepository $teacherRepository , GradeRepository $gradeRepository)
    {
        $this->teacherRepository = $teacherRepository;
        $this->gradeRepository = $gradeRepository;
    }

    public function index()
    {

        $classes = Classes::withCount('students')->orderBy('id')->paginate(10);

        return view('backend.classes.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teachers = $this->teacherRepository->getLatestAll();
        $grades = $this->gradeRepository->getLatestAll();

        return view('backend.classes.create', compact('teachers', 'grades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ClassRequest $request)
    {
        $data = $request->all();
        $class = new Classes();
        $class->name = $data['name'];
        $class->homeroom_teacher = $data['homeroom_teacher'];
        $class->grade_id = $data['grade_id'];
        $class->save();

        return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teachers = Teacher::latest()->get();
        $class = Grade::findOrFail($id);

        return view('backend.classes.edit', compact('class','teachers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'class_name'        => 'required|string|max:255|unique:grades,class_name,'.$id,
            'class_numeric'     => 'required|numeric',
            'teacher_id'        => 'required|numeric',
            'class_description' => 'required|string|max:255'
        ]);

        $class = Grade::findOrFail($id);

        $class->update([
            'class_name'        => $request->class_name,
            'class_numeric'     => $request->class_numeric,
            'teacher_id'        => $request->teacher_id,
            'class_description' => $request->class_description
        ]);

        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Grade  $grade
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $class = Grade::findOrFail($id);

        $class->subjects()->detach();
        $class->delete();

        return back();
    }

    /*
     * Assign Subjects to Grade
     *
     * @return \Illuminate\Http\Response
     */
    public function assignSubject($classid)
    {
        $subjects   = Subject::latest()->get();
        $assigned   = Grade::with(['subjects','students'])->findOrFail($classid);

        return view('backend.classes.assign-subject', compact('classid','subjects','assigned'));
    }

    /*
     * Add Assigned Subjects to Grade
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAssignedSubject(Request $request, $id)
    {
        $class = Grade::findOrFail($id);

        $class->subjects()->sync($request->selectedsubjects);

        return redirect()->route('classes.index');
    }
}
