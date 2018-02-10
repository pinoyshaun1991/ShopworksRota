<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Staff Rota</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <link href="{{ asset('css/rota.css') }}" rel="stylesheet" />
    </head>
    <body>
        <h1 style="text-align: center">Staff Rota</h1>
        <table>
            <tr>
                <th>Staff ID</th>
                @foreach($days as $day)
                    <th>Day {{$day}}</th>
                @endforeach
            </tr>
            @foreach($employees as $id => $employer)
                <tr>
                    <td>{{$id}}</td>
                    @foreach($employer as $day => $time)
                        <td>{{$time['startTime'].' - '.$time['endTime']}}</td>
                    @endforeach
                </tr>
            @endforeach
            <tr>
                <td style="font-weight: bold;">Total Hours/Minutes</td>
            @foreach($totalHours as $totalTime)
                <td><span style="font-weight: bold;">{{$totalTime}}</span> Hours</td>
            @endforeach
            </tr>
            <tfoot>
                <td style="font-weight: bold;">Total Alone Hours/Minutes</td>
            @foreach($totalAloneHours as $totalAloneTime)
                <td><span style="font-weight: bold;">{{$totalAloneTime}}</span> Hours</td>
            @endforeach
            </tfoot>
        </table>
    </body>
</html>

