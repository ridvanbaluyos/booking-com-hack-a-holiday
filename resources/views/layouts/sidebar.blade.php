<p class="lead">Festivals and Holidays</p>
<div class="list-group">
    @foreach (config('app.events') as $id=>$festival)
        <a href="/events/{{ $id }}" class="list-group-item">{{ $festival['name'] }} {{ date('Y', strtotime($festival['start_date'])) }}</a>
    @endforeach
</div>