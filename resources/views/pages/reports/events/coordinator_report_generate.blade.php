<table>
    <thead>
    <tr>
        <th>Site Association</th>
        <th>Event Name</th>
        <th>Event Type</th>
        <th>Event Date (Begin)</th>
        <th>Event Date (End)</th>
        <th>Contact Hours</th>
        <th>Location</th>
    </tr>
    </thead>
    <tbody>
    @foreach($events as $myEvent)
        <tr>
          <td>
            {{$myEvent->site_name}}
          </td>
          <td>
              {{$myEvent->event_name}}
          </td>
          <td>
              {{$myEvent->event_type}}
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
        </tr>
    @endforeach
    </tbody>
</table>
