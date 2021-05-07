@extends('layouts.app', ['activePage' => '', 'titlePage' => __('')])
@section('content')
   <div class="content">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="card card-plain">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Reports</h4>
                        <p class="card-category">
                            Below are the list of reports available.
                        </p>
                    </div>
                    <div class="row">
                        <div class="card">
                            <h5>Report Options</h5>

                            <ul>
                                <li><a href="{{route('reporting.show','students')}}">Get Students</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
