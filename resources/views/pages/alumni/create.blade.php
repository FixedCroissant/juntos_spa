@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Alumni </h4>
                        <p class="card-category">
                            Below are the list of students that have graduated and you can provide information on their current progress
                            after school. <br/>

                            Provide an update on what they have been up to after the Juntos program. <br/>
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item" aria-current="page"><a href="{{route('alumni.index')}}">Alumni/Graduated List</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Alumni/Graduated List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-11 col-sm-11 col-lg-11 offset-1">
                                {!! Form::open(array('route'=>'alumni.store')) !!}
                                <div class="row">
                                    &nbsp;
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Student Selected for Note:
                                        <h4> {{$student->student_first_name}} {{$student->student_last_name}}</h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        Current Location (i.e. Where are they now?)

                                        <br/>
                                        <p>
                                            After Juntos graduation, where did they go? What are they involved in?
                                            <br/>
                                            Please provide this information below:
                                        </p>
                                        <label for="current_alumni_status" class="col-form-label">Alumni Update</label>
                                        <select class="form-control" name="current_alumni_status" id="current_alumni_status">
                                            <option value="">Please select option ...</option>
                                            <br/>
                                            <option value="n_a">N/A</option>
                                            <option value="community_college">Community College</option>
                                            <option value="four_year_university">Four-Year University</option>
                                            <option value="military">Military</option>
                                            <option value="workforce">Workforce</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                       <p>
                                            If the student indicated they're continuing their education, please provide the school name below.
                                            <br/>
                                            This is not required to save your information.
                                        </p>
                                        <label for="current_alumni_school" class="col-form-label">School Name</label>
                                        <input type="text" placeholder="(e.g. NC State University)" class="form-control" maxlength="190" name="current_alumni_school"/>
                                       </div>
                                </div>
                                <div class="row">
                                    {!! Form::hidden('student_id',$student->id) !!}
                                    <div class="col-md-6">
                                        <label for="alumniNotes" class="col-form-label">Notes</label><span class="required">*</span>
                                        {!! Form::textarea('alumni_notes',null,['class'=>'form-control','id'=>'alumniNotes','rows' => 2, 'cols' => 40]) !!}
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        &nbsp;
                                    </div>
                                </div>
                                <div class="row" style="margin-bottom: 125px">
                                    <div class="col-md-12">
                                        {!! Form::submit('Add Alumni Note & Update',array('class'=>'btn btn-sm btn-primary')) !!}
                                    </div>
                                </div>

                                {!! Form::close() !!}

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
