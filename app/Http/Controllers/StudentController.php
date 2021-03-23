<?php

namespace App\Http\Controllers;

use App\Http\Requests\FormvalidateRequest;
use App\Models\Student;
use http\Env\Response;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::latest()->get();
        return view("students.index", compact('students'))->with("i",1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view("students.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(FormvalidateRequest $request)
    {
        $hobby = implode(',', $request->hobby);
        Student::create([
            "name" => $request->name,
            "address" => $request->address,
            "phone" => $request->phone,
            "gender" => $request->gender,
            "hobby" => $hobby,
        ]);

//        return redirect()->route("students.index")->with("success", "Students Data Created Successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        return view("students.show", compact("student"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        return view("students.edit", compact("student"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return false|\Illuminate\Http\RedirectResponse|string
     */
    public function update(FormvalidateRequest $request, Student $student)
    {
        $hobby = implode(',', $request->hobby);
        $request["hobby"] = $hobby;
        $student->update($request->all());

        return response()->json(["success","Data Updated Successfully"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $student
     * @return false|\Illuminate\Http\JsonResponse|string
     */
    public function destroy(Student $student)
    {
        $student->delete();
        return json_encode(array("success"=>"record deleted successfully"));

    }
}
