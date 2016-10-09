<p class="lead">Festivals</p>
<div class="list-group">
    @foreach (config('app.festivals') as $id=>$festival)
        <a href="/festivals/{{ $id }}" class="list-group-item">{{ $festival['name'] }} {{ date('Y', strtotime($festival['start_date'])) }}</a>
    @endforeach
</div>

<p class="lead">Holidays and Events</p>
<div class="list-group">
    <a href="/events/1" class="list-group-item">Laboracay 2017</a>
</div>