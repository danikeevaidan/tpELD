@if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
@endif
<div class="container">
    <table class="table">
        <thead>
            <tr>
                <td>Day</td>
                <td>Time</td>
                <td>Status</td>
            </tr>
        </thead>
        <tbody>
        @foreach($driver->schedule_entries as $entry)
            <tr>
                <td>{{$entry->created_at->format('F d, Y')}}</td>
                <td>{{$entry->created_at->format('H:i')}}</td>
                <td>{{$entry->status}}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
