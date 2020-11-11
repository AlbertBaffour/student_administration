<?php

namespace App\Http\Controllers;

use App\Course;
use App\Programme;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class CourseController extends Controller
{
    public function index(Request $request)
    {
        $programme_id = $request->input('programme_id') ?? '%';
        $programme_des = '%' . $request->input('courseSearch') . '%';

        $courses = Course::with('programme')->orderBy('name')->orderBy('description')
            ->where(function ($query) use ($programme_id, $programme_des) {
                $query->where('programme_id', 'like', $programme_id)
                    ->where('name', 'like', $programme_des);
            })
            ->orWhere(function ($query) use ($programme_id, $programme_des) {
                $query->where('programme_id', 'like', $programme_id)
                    ->where('description', 'like', $programme_des);
            })
            ->get();
        //searched programme
        $searchedProgramme =Programme::
        where(function ($query) use ($programme_id) {
                $query->where('id', 'like', $programme_id);
            })
            ->get()[0]['name'];
        //programmes
        $programmes = Programme::orderBy('name')
            ->get()
            ->transform(function ($item, $key) {
                // Set first letter of name to uppercase and add the counter
                $item->name = strtoupper($item->name);

                // Remove all fields that you don't use inside the view
                unset($item->created_at, $item->updated_at);
                return $item;
            });


        $result = compact('courses','programmes','searchedProgramme');
        Json::dump($result);
        return view('courses.index', $result);

    }
    public function show($id)
{
    $course =Course::with('studentcourses')->with('studentcourses.student')
        ->find($id);
    unset($course->created_at, $course->updated_at);
    $result = compact('course');
    Json::dump($result);
    return view('courses.show', $result);  // Pass $result to the view
}
}
