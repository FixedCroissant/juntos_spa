<table>
    <thead>
    <tr>
        <th>Event Name</th>
        <th>Event Date (Begin)</th>
        <th>Event Date (End)</th>
        <th>Contact Hours</th>
        <th>Location</th>
        <th>Other Siblings</th>
        <th>Other Guests</th>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $myEvent)
        <tr>
          <td>
              {{$myEvent->event_name}}
          </td>
            <td>
                {{$myEvent->event_start_date->format('m/d/y')}}
            </td>
            <td>
                {{$myEvent->event_end_date->format('m/d/y')}}
            </td>
            <td>
                {{$myEvent->contact_hours}}
            </td>
            <td>
                {{$myEvent->event_city}} {{$myEvent->event_state}} {{$myEvent->event_zip}}
            </td>
            <td>
                {{$myEvent->sibling_number}}
            </td>
            <td>
                {{$myEvent->other_guests_number}}
            </td>
        </tr>
        <!--STUDENTS-->
        <tr>
           <td colspan="5">
               STUDENT ATTENDANCE
           </td>
        </tr>
        @foreach($myEvent->attendance as $myStudents)
        <tr>
            <td>
                {{$myStudents->student_first_name}}
            </td>
            <td>
                {{$myStudents->student_last_name}}
            </td>
            <td>
                {{$myStudents->email_address}}
            </td>
            <td>
                {{$myStudents->phone_number}}
            </td>
        </tr>
        @endforeach
        <!--PARENTS-->
        <tr>
            <td colspan="5">
                PARENT/GUARDIAN ATTENDANCE
            </td>
        </tr>
        @foreach($myEvent->parentAttendance as $myParents)
            <tr>
                <td>
                    {{$myParents->parent_first_name}}
                </td>
                <td>
                    {{$myParents->parent_last_name}}
                </td>
                <td>
                    {{$myParents->emailaddress}}
                </td>
                <td>
                    {{$myParents->phone_number}}
                </td>
            </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
