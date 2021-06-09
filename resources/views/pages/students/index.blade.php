@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Student List</h4>
                        <p class="card-category">
                            Below are the list of students in the system.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active" aria-current="page">Student List</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                               {!! Form::open(array('route' => 'students.addeventattendance','method'=>'POST', 'id' => 'frm-example')) !!}

                                <p>
                                    {!! Form::submit('Add to Event Attendance',array('class'=>'btn btn-sm btn-primary')) !!}
                                </p>

                                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm"></th>
                                        <th class="th-sm">Student ID
                                        </th>
                                        <th class="th-sm">Student Name
                                        </th>
                                        <th class="th-sm">Email
                                        </th>
                                        <th class="th-sm">Phone Number
                                        </th>
                                        <th class="th-sm">Active
                                        </th>
                                        <th class="th-sm">Graduated
                                        </th>
                                        <th class="th-sm">County
                                        </th>
                                        <th class="th-sm">
                                            Site Name
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $mystudents)
                                        <tr>
                                            <td>
                                                {{$mystudents->id}}
                                            </td>
                                            <td>
                                                {{$mystudents->student_id}}
                                            </td>
                                            <td>
                                                {{$mystudents->student_first_name}} {{$mystudents->student_last_name}}
                                            </td>
                                            <td>
                                                {{$mystudents->email_address}}
                                            </td>
                                            <td>
                                                {{$mystudents->phone_number}}
                                            </td>
                                            <td>
                                                {{$mystudents->active_student}}
                                            </td>
                                            <td>
                                                @if($mystudents->graduated)
                                                    Yes
                                                @else
                                                    No
                                                @endif
                                            </td>
                                            <td>
                                                {{$mystudents->county}}
                                            </td>
                                            <td>
                                                {{$mystudents->site_name}}
                                            </td>
                                            <td>
                                                {!! link_to_route('students.edit','Edit',$mystudents->id) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                               {{--</form>--}}
                                {!! Form::close() !!}
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
    <script type="text/javascript" src="//gyrocode.github.io/jquery-datatables-checkboxes/1.2.12/js/dataTables.checkboxes.min.js">

    </script>
    <script>
        //Page reload on back button.
        function readyFn( $ ) {
            window.onbeforeunload = function(e) {
              };
        }
        //Use above function.
        $( document ).ready( readyFn );

        $(document).ready(function (){
                var table = $('#dtBasicExample').DataTable({
                    'columnDefs': [
                        {
                            'targets': 0,
                            'checkboxes': {
                                'selectRow': false
                            }
                        }
                    ],
                    'select': {
                        'style': 'multi'
                    },
                    'order': [[1, 'asc']]
                });

                $('#frm-example').on('submit', function(e){
                    var form = this;
                    var rows_selected = table.column(0).checkboxes.selected();

                  // Iterate over all selected checkboxes
                    $.each(rows_selected, function(index, rowId){
                        // Create a hidden element
                        $(form).append(
                            $('<input>')
                                .attr('type', 'hidden')
                                .attr('name', 'id[]')
                                .val(rowId)
                        );
                    });
                });

            });
    </script>
@endpush
