@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Volunteer List</h4>
                        <p class="card-category">
                            Below are the list of volunteers in the system.
                        </p>
                    </div>
                    <div class="row">
                        <div class="card">

                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                               {!! Form::open(array('route' => 'volunteer.addeventattendance','method'=>'POST', 'id' => 'frm-example')) !!}
                                <p>
                                    {!! Form::submit('Add to Event Attendance',array('class'=>'btn btn-sm btn-primary')) !!}
                                </p>

                                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm"></th>
                                        <th class="th-sm">Volunteer Name
                                        </th>
                                        <th class="th-sm">Email
                                        </th>
                                        <th class="th-sm">Phone Number
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
                                    @foreach($volunteers as $thevolunteers)
                                        <tr>
                                            <td>
                                                {{$thevolunteers->id}}
                                            </td>
                                            <td>
                                                {{$thevolunteers->volunteer_first_name}} {{$thevolunteers->volunteer_last_name}}
                                            </td>
                                            <td>
                                                {{$thevolunteers->email_address}}
                                            </td>
                                            <td>
                                                {{$thevolunteers->phone_number}}
                                            </td>
                                            <td>
                                                {{$thevolunteers->site_name}}
                                            </td>
                                            <td>
                                                {!! link_to_route('volunteer.edit','Edit',$thevolunteers->id) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
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
