<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

    <link rel="stylesheet" href="/css/main.css">
    <link rel="stylesheet" href="/css/form.css">

    <!-- Datetime picker -->
    <link rel="stylesheet" type="text/css" href="/datetimepicker/jquery.datetimepicker.css"/>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="/datetimepicker/build/jquery.datetimepicker.full.js"></script>

    <title>Remissio</title>
</head>
<body>
    <nav>
        <img src="/images/logo.png">
        <a href="{{ route('appointment.index') }}">
        <button class="btn btn-header">Terug naar overzicht</button></a>
    </nav>

    <form class="form" method="POST" action="{{ route('appointment.create') }}">
        @csrf
        <span>Nieuwe afspraak maken:</span>
        <div>
            <input readonly="true" id="datetimepicker" name="start_datetime" type="text" placeholder="Kies een datum">
            <input name="name" type="text" placeholder="Vul de naam van de afspraak in">
            <textarea name="description" placeholder="Vul hier notities in (niet verplicht)"></textarea>

            <input type="radio" name="type_of_appointment" value="0">
            <label>Kennismakingsgesprek</label><br>
            <input type="radio" name="type_of_appointment" value="1">
            <label>Regulier gesprek</label>

            <div class="form-actions">
                <a href="{{ route('appointment.index') }}"><button class="btn btn-back">Terug naar overzicht</button></a>
                <a href="{{ route('appointment.create') }}"><button type="submit" class="btn btn-submit">Afspraak opslaan</button>
            </div>
        </div>
    </form>

    <script>
        $('#datetimepicker').datetimepicker({
            format: 'd-m-Y H:i',
            step: 15,
        });
    </script>

</body>
</html>