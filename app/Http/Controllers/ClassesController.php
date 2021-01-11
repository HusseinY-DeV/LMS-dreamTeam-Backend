<?php

namespace App\Http\Controllers;

use App\Classe;
use App\Http\Requests\AddClass;
use App\Http\Requests\UpdateClass;
use App\Http\Requests\UpdateStudent;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    public function many()
    {
        $classes = Classe::paginate(10);
        return $classes;
    }

    public function one($id)
    {
        $class = Classe::find($id);
        if (!$class) {
            $response['message'] = 'Class does not exist';
            return $response;
        }
        return $class;
    }

    public function add(AddClass $request)
    {
        // Validate the incoming data
        $request->validated();

        // Check if the name exists
        $class = Classe::find($request->name);
        if ($class) {
            $response['message'] = 'Class name already exist';
            return $response;
        }

        $class = new Classe();
        $class->name = $request->name;
        $class->save();
        $response['message'] = 'Class added successfully';
        return $response;
    }

    public function update(UpdateClass $request, $id)
    {
        $request->validated();

        // Check if class exists
        $class = Classe::find($id);
        if (!$class) {
            $response['message'] = 'Class does not exist';
            return $response;
        }

        $class->name = $request->name;
        $class->save();
        $response['message'] = 'Class updated successfully';
        return $response;
    }

    public function delete($id)
    {
        // Check if class exists
        $class = Classe::find($id);
        if (!$class) {
            $response['message'] = 'Class does not exist';
            return $response;
        }
        $class->delete();
        $response['message'] = 'Class deleted successfully';
        return $response;
    }
}
