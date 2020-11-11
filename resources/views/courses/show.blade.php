@extends('layouts.template')
@section('title', 'Courses')

@section('main')
    <h1>{{$course->name}}</h1>
    <p>{{$course->description}}</p>
    <p>List of students enrolled:</p>
    <ul>
        @foreach($course->studentcourses as $studentcourse)
        <li>
            {{$studentcourse->student->first_name." ".$studentcourse->student->last_name
                ." (semester ".$studentcourse->semester.")"
            }}
        </li>
            @endforeach
    </ul>
@endsection
