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
        <button class="btn btn-header">Afpsraak maken</button></a>
    </nav>

    <div>
        <input type="text" placeholder="Vul de titel van de afspraak in die je zoekt">
        <button class="btn btn-search"></button>
    </div>

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
            <a href="{{ route('appointment.destroy', ['id' => $event->id]) }}"><button class="btn btn-destroy"></button></a>
            <a href="{{ route('appointment.edit', ['id' => $event->id]) }}"><button class="btn btn-edit"></button></a>
        </div>
        @empty
        <div>
            <div>
                Er zijn geen afspraken gevonden ..
            </div>
        </div>
        @endforelse
    </div>

</body>
</html>