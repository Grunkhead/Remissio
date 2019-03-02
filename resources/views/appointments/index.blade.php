<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/index.css">

    <title>Remissio</title>
</head>
<body>
    <nav>
        <img src="/images/logo.png">
        <a href="{{ route('appointment.new') }}">

        @auth
        <div>
            <button class="btn btn-logout" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Uitloggen') }}
            </button>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        @endauth

        <button class="btn btn-header">Afspraak maken</button></a>
    </nav>
    
    {{ Form::open(array('method' => 'GET', 'route' => 'appointment.search')) }}
        @csrf
        <input name="criteria" type="text" placeholder="Vul de titel van de afspraak in die je zoekt">
        <button type="submit" class="btn btn-search"></button>
    {{ Form::close() }}

    <div class="items">

        <span>Aankomende afspraken:</span>
        @forelse ($events as $event)
        <div>
            <div>
                {{ $event->name }}
            </div>
            <div>
                {{ $event->start->dateTime }}
            </div>
            <a class="btn btn-destroy" href="{{ route('appointment.destroy', ['id' => $event->id]) }}"></a>
            <a class="btn btn-edit" href="{{ route('appointment.edit', ['id' => $event->id]) }}"></a>
        </div>
        @empty
        <div>
            <div>
                Er zijn geen afspraken gevonden ..
            </div>
        </div>
        @endforelse
    </div>

    <script>

        Array.from(document.getElementsByClassName('btn-destroy')).forEach(function(element) {
        element.addEventListener('click', function(event) {

            eventName = event.target.previousElementSibling
                                    .previousElementSibling.innerHTML;

            console.log(eventName);

            if (confirm("De volgende afspraak wordt verwijderd als je doorgaat: " + eventName)) {
                // Send the request
            } else {
                // Stop the request from sending
                event.preventDefault()
            }
        })
    })

    </script>

</body>
</html>