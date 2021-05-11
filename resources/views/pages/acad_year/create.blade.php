@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Create New Academic Year for Student</h4>
                        <p class="card-category">
                            Creating for:
                        <h4>{{$student->student_first_name}} {{$student->student_last_name}}</h4>

                        In order to successfully save, the required fields are marked with a <span class="required">"*"</span>
                        <br/>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('students.edit',$student->id)}}">Student Edit</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Academic Year</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <form action="{{route('acad_year.store')}}" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6 offset-1">
                                    <div class="col-md-5 offset-1">
                                            Create a new academic year and let us know if this is the current year as students can have multiple academic years.
                                            <br/>
                                            <label for="academic_year" class="col-form-label">Academic Year</label><span class="required">*</span>
                                            <input type="text" name="academic_year" placeholder="e.g. 2019-2020" maxlength="9" class="form-control" id="academic_year">

                                        <label for="current" class="col-form-label">Current:</label><span class="required">*</span>
                                        <select name="current" id="current" class="form-control">
                                            <option value="">Is this the current year?</option>
                                            <option value="Y">Yes</option>
                                            <option value="N">No</option>
                                        </select>


                                        <input type="hidden" name="stu_id" value="{{$student->id}}"/>
                                    </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                &nbsp;
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 offset-1">
                                <input type="submit"  class="btn btn-primary btn-sm" value="Provide New Year">
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
