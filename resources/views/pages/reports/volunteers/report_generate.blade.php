<table>
    <thead>
    <tr>
        <th>Volunteer Name</th>
        <th>Address</th>
        <th>City</th>
        <th>State/Zip</th>
        <th>County</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Site</th>
    </tr>
    </thead>
    <tbody>
    @foreach($volunteers as $volunteer)
        <tr>
            <td>{{ $volunteer->volunteer_first_name }}{{ $volunteer->volunteer_last_name }}</td>
            <td>{{$volunteer->address_line_1}}</td>
            <td>{{$volunteer->city}}</td>
            <td>{{$volunteer->state}} {{$volunteer->zip}}</td>
            <td>{{$volunteer->county}}</td>
            <td>{{ $volunteer->email_address }}</td>
            <td>{{ $volunteer->phone_number }}</td>
            <td>{{$volunteer->site_name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>
