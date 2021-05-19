@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Parent List</h4>
                        <p class="card-category">
                            Below are the list of parents in the system.
                        </p>
                    </div>
                    <div class="row">
                        <div class="col-md-3 col-lg-3 offset-8">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item active">List Parents</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">

                                {!! Form::open(array('route' => 'parents.addeventattendance','method'=>'POST', 'id' => 'parent-attendance')) !!}
                                <p>
                                    {!! Form::submit('Add to Event Attendance',array('class'=>'btn btn-sm btn-primary')) !!}
                                </p>

                                <table id="dtBasicExample" class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th class="th-sm"></th>
                                        <th class="th-sm">Parent Name
                                        </th>
                                        <th class="th-sm">Student Name
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
                                    @foreach($parents as $myParents)
                                        <tr>
                                            <td>
                                                {{$myParents->id}}
                                            </td>
                                            <td>
                                                {{$myParents->parent_first_name}} {{$myParents->parent_last_name}}
                                            </td>
                                            <td>
                                                {{$myParents->student_first_name}} {{$myParents->student_last_name}}
                                            </td>
                                            <td>
                                                {{$myParents->emailaddress}}
                                            </td>
                                            <td>
                                                {{$myParents->phone_number}}
                                            </td>
                                            <td>
                                                {{$myParents->site_name}}
                                            </td>
                                            <td>
                                               {!! link_to_route('parents.edit','Edit',$myParents->id) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                               </form>
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
                    }
                });

            $('#parent-attendance').on('submit', function(e){
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
