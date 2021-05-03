@extends('layouts.app', ['activePage' => 'eventList', 'titlePage' => __('Events')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Event List</h4>
                        <p class="card-category">
                            Below are the list of events currently in the system.
                        </p>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                <table id="eventList" class="table table-striped table-bordered" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm">Event Name
                                        </th>
                                        <th class="th-sm">Event City
                                        </th>
                                        <th class="th-sm">Event State
                                        </th>
                                        <th class="th-sm">Event Type
                                        </th>
                                        <th class="th-sm">Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($events as $myevents)
                                        <tr>
                                            <td>
                                                {{$myevents->event_name}}
                                            </td>
                                            <td>
                                                {{$myevents->event_city}}
                                            </td>
                                            <td>
                                                {{$myevents->event_state}}
                                            </td>
                                            <td>
                                                {{$myevents->event_type}}
                                            </td>
                                            <td>
                                                {!! link_to_route('event.edit','Edit',$myevents->id) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!--End Table-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        $(document).ready(function () {
            $('#eventList').DataTable();
        });
    </script>
@endpush
