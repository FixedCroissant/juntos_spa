<!--FOLLOW UP APPOINTMENT-->
<div class="row">
    &nbsp;
</div>
<div class="row">
    <div class="col-md-8">
        <h4>Follow Up Coaching Appointment</h4>
        <label for="studentName" class="col-form-label">Select Student:</label><span class="required">*</span>
        <br/>
        <select name="student_name">
            @foreach($students as $myStudents)
                <option value="{{ $myStudents->id }}">{{ $myStudents->student_full_name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="coachingAppointmentDate" class="col-form-label">Appointment Date:</label>
        {!! Form::text('appointment_date',null,['class'=>'form-control','id'=>'coachingAppointmentDate']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="methodOfContact" class="col-form-label">Method of Contact:</label><span class="required">*</span>
        {!! Form::select('contactMethod', ['phone'=>'Phone Call','Face-To-Face'=>'Face to Face'], null, ['class'=>'form-control','id'=>'methodOfContact','placeholder' => 'Select Contact Method...']); !!}
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <label for="followUpNotes" class="col-form-label">Follow Up Appointment Notes:</label>
        {!! Form::text('follow_up_notes', null, ['id'=>'appointmentNotes','class'=>'form-control']); !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="actionsNeeded" class="col-form-label">Actions Needed:</label>
        {!! Form::text('actions_needed',null,['class'=>'form-control','id'=>'actionsNeeded']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="actionsMade" class="col-form-label">Actions Made:</label>
        {!! Form::text('actions_made',null,['class'=>'form-control','id'=>'actionsMade']) !!}
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <label for="results" class="col-form-label">Results:</label>
        {!! Form::text('results',null,['class'=>'form-control','id'=>'results']) !!}
    </div>
</div>
