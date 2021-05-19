@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Edit Student</h4>
                        <p class="card-category">
                            Please edit a new student in the system.
                            <br/>
                            You are now able to create a parent record.

                            <span class="required">"*"</span>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('students.index')}}">Student List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Edit Student</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="card">
                        <div class="row">
                            <div class="col-md-5 offset-1">
                                <b>Student Contact Information</b>
                                {!!   Form::model($student, ['route' => ['students.update', $student->id],'class'=>'form-horizontal','method'=>'PATCH']) !!}
                                <div class="row">
                                    &nbsp;
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="firstName" class="col-form-label">First Name </label><span class="required">*</span>
                                        {!! Form::text('student_first_name',null,['class'=>'form-control','id'=>'firstName']) !!}
                                    </div>

                                    <div class="col-md-3">
                                        <label for="lastName" class="col-form-label">Last Name</label><span class="required">*</span>
                                        {!! Form::text('student_last_name',null,['class'=>'form-control','id'=>'lastName']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="address" class="col-form-label">Address</label><span class="required">*</span>
                                        {!! Form::text('address_line_1',null,['class'=>'form-control','id'=>'address']) !!}
                                    </div>

                                    <div class="col-md-3">
                                        <label for="city" class="col-form-label">City</label><span class="required">*</span>
                                        {!! Form::text('city',null,['class'=>'form-control','id'=>'city']) !!}
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="state" class="col-form-label">State</label><span class="required">*</span>
                                        {!! Form::select('state', $stateOptions, null, ['class'=>'form-control','placeholder' => 'Pick a state...']); !!}
                                    </div>

                                    <div class="col-md-3">
                                        <label for="zip" class="col-form-label">Zip</label><span class="required">*</span>
                                        {!! Form::text('zip',null,['class'=>'form-control','id'=>'zip']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="studentID" class="col-form-label">StudentID</label><span class="required">*</span>
                                        {!! Form::text('student_id', null, ['class'=>'form-control','maxlength'=>'12']); !!}
                                    </div>
                                </div>

                                <!--New Fields-->
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="grade" class="col-form-label">Grade</label><span class="required">*</span>
                                        {!! Form::select('grade', $gradeOptions, $student->grade, ['class'=>'form-control','placeholder' => 'Pick a grade...']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <label for="emailaddress" class="col-form-label">E-Mail Address</label>
                                        {!! Form::text('email_address',null,['class'=>'form-control','id'=>'emailaddress','maxlength'=>'60']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="active_student" class="col-form-label">Active in Juntos?</label><span class="required">*</span>
                                        {!! Form::select('active_student', ['Y'=>"Yes",'N'=>"No"], null, ['class'=>'form-control','placeholder' => 'Pick a selection...']); !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="dob" class="col-form-label">Date of Birth</label>
                                        {!! Form::text('dob', null, ['class'=>'form-control','id'=>'dob']); !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="age" class="col-form-label">Age</label>
                                        {!! Form::selectRange('age', 1, 25,null,['class'=>'form-control','id'=>'age']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        Graduated Student?
                                        <input type="checkbox" name="graduated" value="1" {{ $student->graduated ? 'checked="checked"' : '' }}/>
                                    </div>
                                    <div class="col-md-8">
                                        Clicking this box will place your individual in the alumni category.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="academic_year" class="col-form-label">Academic Year</label>
                                        <select class="form-control" name="site_id">
                                            <option value="" class="form-control">Please select Academic Year for Student:</option>
                                            @foreach($academicYear as $theAcademicYear)
                                                <option value="{{$theAcademicYear->id}}" {{ $theAcademicYear->id == $student->id ? 'selected' : '' }}>{{$theAcademicYear->academic_year}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="academic_year" class="col-form-label">Generate New Academic Year</label>
                                        <br/>
                                        <a href="{{route('acad_year.create',['student'=>$student->id])}}" class="btn btn-sm btn-primary">Provide New Academic Year</a>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-7">
                                        Please note that academic years correspond with the students schedule as well.
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="county" class="col-form-label">County</label>
                                        {!! Form::text('county',null,['class'=>'form-control','id'=>'county','maxlength'=>'60']) !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="school_name" class="col-form-label">School Name</label>
                                        {!! Form::text('school_name',null,['class'=>'form-control','id'=>'school_name','maxlength'=>'60']) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="site" name="site_id" class="col-form-label">Site Association</label>
                                        <select class="form-control" name="site_id">
                                            <option value="" class="form-control">Please select a site:</option>
                                            @foreach($siteOption as $siteOptionsAvailable)
                                                <option value="{{$siteOptionsAvailable->id}}" {{ $siteOptionsAvailable->id == $student->site_id ? 'selected' : '' }}>{{$siteOptionsAvailable->site_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="ethnicity" class="col-form-label">Ethnicity</label>
                                        {!! Form::select('ethnicity', ['Latino'=>'Latino','White'=>"White",'Black or African American'=>"Black or African American",'American Indian'=>'American Indian','Asian'=>'Asian','Native Hawaiian or Other Pacific Islander'=>'Native Hawaiian or Other Pacific Islander'], null, ['class'=>'form-control','placeholder' => 'Pick a selection...']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <label for="pre_survey_completed" class="col-form-label">Pre Survey Complete?</label>
                                        {!! Form::select('pre_survey_completed', ['Y'=>"Yes",'N'=>"No"], null, ['class'=>'form-control','placeholder' => 'Pick a selection...']); !!}
                                    </div>
                                    <div class="col-md-3">
                                        <label for="post_survey_completed" class="col-form-label">Post Survey Complete?</label>
                                        {!! Form::select('post_survey_completed', ["Y"=>"Yes","N"=>"No"], null, ['class'=>'form-control','placeholder' => 'Pick a selection...']); !!}
                                    </div>
                                </div>
                                <div class="row">
                                    &nbsp;
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        {!! Form::submit('Update Student',array('class'=>'btn btn-sm btn-primary')) !!}
                                    </div>
                                </div>

                                <div class="row" style="margin-top:25px;">
                                    <div class="col-md-3">
                                        <a href="{{route('students.index')}}">Go back to student list.</a>
                                    </div>
                                </div>
                                <!--End New Fields-->
                                {!! Form::close() !!}
                            </div>
                            <div class="col-md-1">
                                <!-- Content -->
                                &nbsp;
                            </div>
                            <div class="col-md-5">
                                <b>Parent/Guardian Information</b>
                                <p>
                                    <a href="{{ route('parents.create',['id'=>$student->id]) }}" class="btn btn-sm">Create New Parent/Guardian Record</a>
                                 </p>
                                <div class="row">
                                    <div class="col-md-7">
                                        <ul>
                                         @foreach($student->parent as $myParents)
                                             <div class="row related">
                                                 <li>
                                                 {{$myParents->parent_first_name}} {{$myParents->parent_last_name}}  |     <a class="btn btn-sm" href="{{route('parents.edit',[$myParents->id])}}">EDIT</a> |
                                                </li>
                                                 {!!  Form::open(array('route' => array('parents.destroy', $myParents->id),'style'=>'display:inline-block', 'method' => 'delete','style'=>'display:inline','onsubmit' => "return confirm('Are you sure you want to delete this item?')",))  !!}
                                                 <button type="submit"  class="button-link btn btn-sm">DELETE</button>
                                                 {!! Form::close()  !!}
                                             </div>
                                          @endforeach
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            &nbsp;
                        </div>
                        <div class="row">
                            <div class="col-sm-12 col-md-12 offset-1">
                                <!--Start Nav tabs-->
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="#" role="presentation">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#notes" role="tab" aria-controls="home" aria-selected="true">Notes</a>
                                    </li>
                                    <li class="#" role="presentation">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#events" role="tab" aria-controls="profile" aria-selected="false">Events</a>
                                    </li>
                                    <li class="#" role="presentation">
                                        <a class="nav-link" id="messages-tab" data-toggle="tab" href="#coaching" role="tab" aria-controls="messages" aria-selected="false">Student Coaching</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div class="tab-pane active" id="notes" role="tabpanel" aria-labelledby="home-tab">
                                        Current Notes:
                                        <ul>
                                            @foreach($student->notes as $myStudentNote)
                                            <li>
                                             {{$myStudentNote->created_at->format('m/d/y h:i')}}- from {{$myStudentNote->user->name}}  {{$myStudentNote->student_note_text}} / <a href="{!! route('studentnotes.edit',$myStudentNote->id)!!}">Edit Note</a>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <a href="{{route('studentnotes.create',['student'=>$student->id])}}" class="btn btn-sm btn-primary">Create New Note</a>
                                    </div>
                                    <div class="tab-pane" id="events" role="tabpanel" aria-labelledby="profile-tab">
                                        <ul>
                                            @foreach($student->attendance as $myEvents)
                                                <li>
                                                    {{$myEvents->event_start_date->format('m/d/y')}} {{$myEvents->event_name}}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="tab-pane" id="coaching" role="tabpanel" aria-labelledby="messages-tab">
                                        <ul>
                                        @foreach($student->coachAppointments as $myAppointments)
                                            <li>
                                                {{$myAppointments->appointment_date->format('m/d/y')}} with {{$myAppointments->coach->name}}
                                            </li>
                                        @endforeach
                                        </ul>
                                    </div>
                                </div>

                                <!-- End Tabs navs -->
                            </div>
                        </div>
                    </div><!--END CARD-->
                </div>
            </div>
        </div>
    </div>
@endsection
