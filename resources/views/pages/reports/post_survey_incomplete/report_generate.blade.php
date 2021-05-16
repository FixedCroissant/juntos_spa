<table>
    <thead>
    <tr>
        <th>Student Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State/Zip</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Ethnicity</th>
        <th>School Name</th>
        <th>County</th>
        <th>Age</th>
        <th>DOB</th>
        <th>Grade</th>
        <th>Site</th>
        <th>Active in Juntos</th>
        <th>Academic Years</th>
        <th>Pre Survey Complete</th>
        <th>Post Survey Complete</th>
        <th>Graduated</th>
    </tr>
    </thead>
    <tbody>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->student_first_name }}{{ $student->student_last_name }}</td>
            <td>{{$student->address_line_1}}</td>
            <td>{{$student->city}}</td>
            <td>{{$student->state}} {{$student->zip}}</td>
            <td>{{ $student->email_address }}</td>
            <td>{{ $student->phone_number }}</td>
            <td>{{ $student->ethnicity }}</td>
            <td>{{ $student->school_name }}</td>
            <td>{{ $student->county }}</td>
            <td>{{ $student->age }}</td>
            <td>{{ $student->dob }}</td>
            <td>{{ $student->grade }}</td>
            <td>{{ $student->site_name }}</td>
            <td>{{ $student->active_student }}</td>
            <td>{{ $student->academic_year }}</td>
            <td>{{ $student->pre_survey_completed }}</td>
            <td>{{ $student->post_survey_completed }}</td>
            <td>{{$student->graduated ? "Y":"N"}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
