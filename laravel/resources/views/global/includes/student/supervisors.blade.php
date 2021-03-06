<div class="panel panel-default">
    <div class="panel-heading">Supervisors</div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#current_supervisors" data-toggle="tab" aria-expanded="true">Current <span class="badge">{{ $current_supervisors->count() }}</span></a>
            </li>
            <li class=""><a href="#previous_supervisors" data-toggle="tab" aria-expanded="false">Previous <span class="badge">{{ $previous_supervisors->count() }}</span></a>
            </li>
            <li class=""><a href="#all_supervisors" data-toggle="tab" aria-expanded="false">All <span class="badge">{{ $all_supervisors->count() }}</span></a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div role="tabpanel" class="tab-pane fade active in" id="current_supervisors" aria-labelledby="current_supervisors-tab">
                @if (count($current_supervisors->all()) > 0 )
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="current_supervisors_table">
                        <thead>
                            <tr>
                                <th>Supervisor</th>
                                <th>Order</th>
                                <th>Start</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($current_supervisors->all() as $supervisor)
                            <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                <td><a href="{{ action('StaffController@show', ['id' => $supervisor->staff->id]) }}">{{ $supervisor->staff->user->full_name }}</a></td>
                                <td>{{ $supervisor->order }}</td>
                                <td>{{ $supervisor->start }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                This student does not have any current supervisors.
                @endif
            </div>
            <div role="tabpanel" class="tab-pane fade" id="previous_supervisors" aria-labelledby="previous_supervisors-tab">
                @if (count($previous_supervisors->all()) > 0 )
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="previous_supervisors_table">
                        <thead>
                            <tr>
                                <th>Supervisor</th>
                                <th>Order</th>
                                <th>Start</th>
                                <th>End</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($previous_supervisors->all() as $supervisor)
                            <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                <td><a href="{{ action('StaffController@show', ['id' => $supervisor->staff->id]) }}">{{ $supervisor->staff->user->full_name }}</a></td>
                                <td>{{ $supervisor->order }}</td>
                                <td>{{ $supervisor->start }}</td>
                                <td>{{ $supervisor->end }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                This student does not have any previous supervisors.
                @endif
            </div>
            <div role="tabpanel" class="tab-pane fade" id="all_supervisors" aria-labelledby="all_supervisors-tab">
                @if (count($all_supervisors->all()) > 0 )
                <div class="table-responsive">
                    <table class="table table-hover dataTable" id="all_supervisors_table">
                        <thead>
                            <tr>
                                <th>Supervisor</th>
                                <th>Order</th>
                                <th>Start</th>
                                <th>End</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($all_supervisors->all() as $supervisor)
                            <tr class="clickable" href="{{ action('SupervisorsController@show', ['id' => $supervisor->id]) }}">
                                <td><a href="{{ action('StaffController@show', ['id' => $supervisor->staff->id]) }}">{{ $supervisor->staff->user->full_name }}</a></td>
                                <td>{{ $supervisor->order }}</td>
                                <td>{{ $supervisor->start }}</td>
                                <td>@if ($supervisor->end === null)<span class="label label-success">Current supervisor</span>@else{{ $supervisor->end }}@endif</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                This student does not have any supervisors.
                @endif
            </div>
        </div>
    </div>
    <!-- /.panel-body -->
    @if (Entrust::can('can_create_supervision_record'))
    <div class="panel-footer">
        <div class="btn-group">
            <a class="btn btn-primary" href="{{ action('SupervisorsController@createForStudent', ['enrolment' => $student->enrolment]) }}">Add new supervisor</a>
        </div>
    </div>
    @endif
</div>
<script type="text/javascript">
    $('#current_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#previous_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $('#all_supervisors').on( 'click', 'tbody tr', function () {
        window.location.href = $(this).attr('href');
    } );
    $(document).ready(function() {
        $('#current_supervisors_table').dataTable( {
            "order": [[ 1, "asc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
        $('#previous_supervisors_table').dataTable( {
            "order": [[ 3, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
        $('#all_supervisors_table').dataTable( {
            "order": [[ 3, "desc" ]],
            "paging":   false,
            "filter":   false,
            "info":     false
        } );
    });
</script>