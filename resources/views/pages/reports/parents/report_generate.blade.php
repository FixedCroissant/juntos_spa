<table>
    <thead>
    <tr>
        <th>Associated Student Last Name</th>
        <th>Associated Student First Name</th>
        <th>Parent Last Name</th>
        <th>Parent First Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State/Zip</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Pre Survey Complete</th>
        <th>Post Survey Complete</th>
    </tr>
    </thead>
    <tbody>
    @foreach($parents as $myParents)
        <tr>
            <td>{{$myParents->student_last_name}}</td>
            <td>{{$myParents->student_first_name}}</td>
            <td>{{ $myParents->parent_last_name }}</td>
            <td>{{ $myParents->parent_first_name }}</td>
            <td>{{$myParents->address_line_1}}</td>
            <td>{{$myParents->city}}</td>
            <td>{{$myParents->state}} {{$myParents->zip}}</td>
            <td>{{$myParents->emailaddress }}</td>
            <td>{{$myParents->phone_number }}</td>
            <td>{{$myParents->pre_survey_completed }}</td>
            <td>{{$myParents->post_survey_completed }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
