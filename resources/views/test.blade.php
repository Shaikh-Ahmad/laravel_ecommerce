<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;

            }

        </style>
    </head>
    <body>
        <div class="container" style="margin-top: 100px">
            <div class="row" >
                <div class="col-md-25 " style="background-color: blue ; color:white">
                    row 2 col-25
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-20"  style="background-color: blue ; color:white">
                    row 2 col-20
                </div>
            </div>
            <div class="row" style="margin-top: 10px">
                <div class="col-md-11"  style="background-color: blue ; color:white">
                    row 3 col-11
                </div>
            </div>
        </div>
    </body>
</html>
