<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Http\Requests\AddSection;
use App\Http\Requests\UpdateSection;
use App\Section;
use Illuminate\Http\Request;

class SectionsController extends Controller
{
    public function many(Request $request)
    {
        if ($request->query('_ALL') == 1) {
            return Section::all();
        }
        $sections = Section::paginate(10);
        return $sections;
    }

    public function one($id)
    {
        $section = Section::find($id);
        if (!$section) {
            $response['message'] = 'Section does not exist';
            return $response;
        }
        return $section;
    }

    public function students($id)
    {
        $section = Section::find($id);
        if (!$section) {
            $response['message'] = 'Section does not exist';
            return $response;
        }
        return $section->students;
    }

    public function add(AddSection $request)
    {
        // Validate the incoming data
        $request->validated();

        // Check if the class exists
        $class = Classe::find($request->class_id);
        if (!$class) {
            $response['message'] = 'Class does not exist';
            return $response;
        }

        // Check if the name exists
        $section = Section::find($request->name);
        if ($section) {
            $response['message'] = 'Section name already exist';
            return $response;
        }

        $section = new Section();
        $section->name = $request->name;
        $section->number_of_students = $request->number_of_students;
        $section->class_id = $request->class_id;
        $section->save();
        $response['message'] = 'Section added successfully';
        return $response;
    }

    public function update(UpdateSection $request, $id)
    {
        $request->validated();

        // Check if section exists
        $section = Section::find($id);
        if (!$section) {
            $response['message'] = 'Section does not exist';
            return $response;
        }

        // Check if the class exists
        $class = Classe::find($request->class_id);
        if (!$class) {
            $response['message'] = 'Class does not exist';
            return $response;
        }

        $section->name = $request->name;
        $section->number_of_students = $request->number_of_students;
        $section->class_id = $request->class_id;
        $section->save();
        $response['message'] = 'Section updated successfully';
        return $response;
    }

    public function delete($id)
    {
        // Check if section exists
        $section = Section::find($id);
        if (!$section) {
            $response['message'] = 'Section does not exist';
            return $response;
        }
        $section->delete();
        $response['message'] = 'Section deleted successfully';
        return $response;
    }
}
