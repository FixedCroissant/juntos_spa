@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Volunteer - Add to Event</h4>
                        <p class="card-category">
                            Please select an event for the following volunteers to attend:
                        </p>
                    </div>
                    <div class="row">
                        <div class="card">
                            <div class="col-xs-8 col-sm-8 col-lg-8 offset-1">
                                <p>
                                    Selected volunteers:
                                    <ul>
                                        @foreach($selectedVolunteers as $mySelectedVolunteers)
                                        <li>
                                            {{$mySelectedVolunteers->volunteer_first_name}} {{$mySelectedVolunteers->volunteer_last_name}}
                                        </li>
                                          @endforeach
                                    </ul>
                                </p>
                            {!! Form::select('eventOptions', $eventOptions, null, ['class'=>'form-control','placeholder' => 'Pick an event...']); !!}

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
@endpush
