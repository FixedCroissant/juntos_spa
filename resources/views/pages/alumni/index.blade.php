@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Alumni List</h4>
                        <p class="card-category">
                            Below are the list of students that have graduated and you can provide information on their current progress
                            after school.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Alumni/Graduated List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                            <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">Student ID
                                        </th>
                                        <th class="th-sm">Student Name
                                        </th>
                                        <th class="th-sm">Email
                                        </th>
                                        <th class="th-sm">Phone Number
                                        </th>
                                        <th class="th-sm">Graduated
                                        </th>
                                        <th class="th-sm">
                                            Site Name
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($graduatedStudents as $myGraduatedStudents)
                                        <tr>
                                            <td>
                                                {{$myGraduatedStudents->student_id}}
                                            </td>
                                            <td>
                                                {{$myGraduatedStudents->student_first_name}} {{$myGraduatedStudents->student_last_name}}
                                            </td>
                                            <td>
                                                {{$myGraduatedStudents->email_address}}
                                            </td>
                                            <td>
                                                {{$myGraduatedStudents->phone_number}}
                                            </td>
                                            <td>
                                                @if($myGraduatedStudents->graduated)
                                                    Yes
                                                @endif
                                            </td>
                                            <td>
                                                {{$myGraduatedStudents->site_name}}
                                            </td>
                                            <td>
                                                {!! link_to_route('alumni.create','Add Notes for Student',['student'=>$myGraduatedStudents->id]) !!} |
                                                {!! link_to_route('alumni.edit','See/Update Notes for Student',[$myGraduatedStudents->id]) !!} |
                                                {!!  Form::open(array('route' => array('alumni.destroy',$myGraduatedStudents->id),'style'=>'display:inline-block', 'method' => 'delete','style'=>'display:inline','onsubmit' => "return confirm('Are you sure you want to remove this note?')",))  !!}
                                                <button type="submit"  class="button-link btn btn-sm">Remove Note</button>
                                                {!! Form::close()  !!}

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
