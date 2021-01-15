<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddStudent;
use App\Http\Requests\UpdateStudent;
use App\Section;
use App\Student;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentsController extends Controller
{
    public function many(Request $request)
    {
        if ($request->query('student')) {
            $students = Student::with(['section', 'section.class'])
                ->where('first_name', 'LIKE', '%' . $request->query('student') . '%')
                ->paginate(10);
            return $students;
        }
        $students = Student::with(['section', 'section.class'])->paginate(10);
        return $students;
    }

    public function one($id)
    {
        $student = Student::with(['section', 'section.class'])->find($id);
        if (!$student) {
            $response['message'] = 'Student does not exist';
            return $response;
        }
        return $student;
    }

    public function add(AddStudent $request)
    {
        // Validate the incoming data
        $request->validated();

        // Check if the section exists
        $section = Section::find($request->section_id);
        if (!$section) {
            $response['message'] = 'Section does not exist';
            return $response;
        }

        // Check if section is full
        if (Student::where('section_id', $request->section_id)->count() == $section->number_of_students) {
            $response['message'] = 'Section is full';
            return $response;
        }

        $path = "";
        if ($request->file) {
            $path = Storage::disk('public')->put('', $request->file);
        }

        $student_id = IdGenerator::generate(['table' => 'students', 'field' => 'student_id', 'length' => 9, 'prefix' => 'ST-' . date('y')]);
        $student = new Student();
        $student->student_id = $student_id;
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($path != "") {
            $student->picture = $path;
        } else {
            $student->picture = $request->picture;
        }
        $student->section_id = $request->section_id;
        $student->save();
        return $student;
        $response['message'] = 'Student added successfully';
        return $response;
    }

    public function update(UpdateStudent $request, $id)
    {
        $request->validated();

        // Check if student exists
        $student = Student::find($id);
        if (!$student) {
            $response['message'] = 'Student does not exist';
            return $response;
        }

        // Check if the section exists
        $section = Section::find($request->section_id);
        if (!$section) {
            $response['message'] = 'Section does not exist';
            return $response;
        }
        if ($section->id != $request->section_id) {
            // Check if section is full
            if (Student::where('section_id', $request->section_id)->count() == $section->number_of_students) {
                $response['message'] = 'Section is full';
                return $response;
            }
        }

        $path = "";
        if ($request->file) {
            if ($student->picture) {
                Storage::disk('public')->delete($student->picture);
                $path = Storage::disk('public')->put('', $request->file);
            } else {
                $path = Storage::disk('public')->put('', $request->file);
            }
        }

        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->email = $request->email;
        $student->phone = $request->phone;
        if ($path != "") {
            $student->picture = $path;
        }
        $student->section_id = $request->section_id;
        $student->save();
        $response['message'] = 'Student updated successfully';
        return $response;
    }

    public function delete($id)
    {
        // Check if student exists
        $student = Student::find($id);
        if (!$student) {
            $response['message'] = 'Student does not exist';
            return $response;
        }
        if ($student->picture) {
            Storage::disk('public')->delete($student->picture);
        }
        $student->delete();
        $response['message'] = 'Student deleted successfully';
        return $response;
    }
}