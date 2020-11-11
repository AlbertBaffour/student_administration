@section('script_after')
    <script>
        $(function () {
            // Add shadow to card on hover
            $('.card').hover(function () {
                $(this).addClass('shadow');
            }, function () {
                $(this).removeClass('shadow');
            });
            // submit form when leaving text field
            $('#courseSearch').blur(function () {
                $('#searchForm').submit();
            });
            // submit form when changing dropdown list
            $('#programme_id').change(function () {
                $('#searchForm').submit();
            });
        })
    </script>
@endsection
@extends('layouts.template')
@section('title', 'Courses')

@section('main')
    <h1>Courses</h1>
    <form method="get" action="/courses" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="courseSearch" id="courseSearch"
                       value="{{ request()->courseSearch }}"
                       placeholder="Filter Course Name Or Description">
            </div>
            <div class="col-sm-4 mb-2">
                <select class="form-control" name="programme_id" id="programme_id">
                    <option value="%">All programmes</option>
                    @foreach($programmes as $programme)
                        <option value="{{ $programme->id }}"
                            {{ (request()->programme_id ==  $programme->id ? 'selected' : '') }}>{{ $programme->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2 mb-2">
                <button type="submit" class="btn btn-success btn-block">Search</button>
            </div>

        </div>
    </form>
    <hr>
    @if ($courses->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Can't find any course with <b>'{{ request()->courseSearch }}'</b>
            {{ request()->programme_id=="%"  ? "":"for the programme " }}<b>{{request()->programme_id=="%"  ? "":"'".$searchedProgramme."'"}}</b>

            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif

    <div class="row align-items-stretch">
        @foreach($courses as $course)
        <div class="d-flex col-sm-6 col-md-4 col-lg-3 mb-3 ">
            <div class="card w-100">
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">{{$course->name}}</h5>
                    <p class="card-text">{{$course->description}}</p>
                    <p class="card-text text-primary ">{{strtoupper($course->programme->name)}}</p>
                     </div>
                <div class="card-footer d-flex justify-content-between">
                    <a href="courses/{{ $course->id }}" class="btn btn-info text-white btn-sm btn-block">Manage students</a>

                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection
