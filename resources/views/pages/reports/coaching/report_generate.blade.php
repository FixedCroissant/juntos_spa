<table>
    <thead>
    <tr>
        <th>Initial Appointment Date</th>
        <th>Site Association</th>
        <th>Student Name</th>
        <th>Coach Name</th>
        <th>Start GPA</th>
        <th>End GPA</th>
        <th>Method of Contact</th>
        <th>Appointment Duration</th>
        <th>Goals</th>
        <th>Actions Needed</th>
        <th>Follow Up Appointment Date (if set)</th>
        <th>Follow Up Appointment Duration</th>
        <th>Follow Up Appointment Method of Contact</th>
        <th>Follow Up Notes</th>
        <th>Actions Made</th>
        <th>Results</th>
    </tr>
    </thead>
    <tbody>
    @foreach($appointments as $specificAppointment)
        <tr>
            <td>{{$specificAppointment->appointment_date}}</td>
            <td>{{$specificAppointment->site_name}}</td>
            <td>{{$specificAppointment->student_first_name}} {{$specificAppointment->student_last_name}}</td>
            <td>{{$specificAppointment->name}}</td>
            <td>{{$specificAppointment->start_gpa}}</td>
            <td>{{$specificAppointment->end_gpa}}</td>
            <td>{{$specificAppointment->method_of_contact}}</td>
            <td>{{$specificAppointment->appointment_duration}}</td>
            <td>{{$specificAppointment->EducationalGoals}}</td>
            <td>{{$specificAppointment->actions_needed}}</td>
            <td>{{$specificAppointment->appointment_follow_up_date}}</td>
            <td>{{$specificAppointment->appointment_follow_up_duration}}</td>
            <td>{{$specificAppointment->appointment_follow_up_method_of_contact}}</td>
            <td>{{$specificAppointment->follow_up_notes}}</td>
            <td>{{$specificAppointment->actions_made}}</td>
            <td>{{$specificAppointment->results}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
