@extends('layouts.layout')

@section('content')
<div class="mdc-layout-grid__cell stretch-card mdc-layout-grid__cell--span-12">
    <div class="mdc-card p-0">
        <h6 class="card-title card-padding pb-0">Audit Logs</h6>
        @isset($logs)
        @empty($logs)
        <p>No activity log recorded yet. </p>
        @else
        <div class="table-responsive">
            <table class="table table-hoverable">
                <thead>
                    <tr>
                        <th>SN</th>
                        <th class="text-left">Title</th>
                        <th>Action</th>
                        <th>Admin</th>
                        <th>Subject</th>
                        <th>Ip Address</th>
                        <th>Date and Time</th>
                    </tr>
                </thead>
                <tbody>
                    @php($count = 0)
                    @foreach($logs as $log)
                    <tr>
                        <td>{{ ++$count }}</td>
                        <td class="text-left">{{ $log->title }}</td>
                        <td>{{ $log->action }}</td>
                        <td>{{ $log->admin }}</td>
                        <td>{{ $log->subject }}</td>
                        <td>{{ $log->ip_address }}</td>
                        <td>{{ date('l jS F Y g:i:a', strtotime($log->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <button type="button" class="export_btn" title="{{ "Audit Logs ".date('l jS F Y \a\t g:i:a') }}">Export to CSV</button>
        </div>
        @endempty
        @else
        <p>No activity log recorded yet. </p>
        @endisset

    </div>
</div>




@endsection
