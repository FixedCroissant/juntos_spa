@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
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
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('event.index')}}">Event List</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                <table id="events" class="table table-striped table-bordered" cellspacing="0" width="100%">
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
                                        <th class="th-sm">Site
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
                                                {{$myevents->site_name}}
                                            </td>
                                            <td class="align-content-md-center">
                                                {!! link_to_route('event.show','Attendance',$myevents->id) !!} |
                                                {!! link_to_route('event.edit','Edit',$myevents->id) !!} |
                                                {!!  Form::open(array('route' => array('event.destroy',$myevents->id),'style'=>'display:inline-block', 'method' => 'delete','style'=>'display:inline','onsubmit' => "return confirm('Are you sure you want to remove this event? It will remove attendance associated!')",))  !!}
                                                <button type="submit"  class="button-link btn btn-sm">Remove</button>
                                                {!! Form::close()  !!}
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
        $(document).ready( function () {
            $('#events').DataTable();
        } );
    </script>
@endpush
