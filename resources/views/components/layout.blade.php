<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Statspire</title>
        <link rel="stylesheet" href="{{ asset('css/variable.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    </head>
    <style>
        @font-face {
            font-family: "SourceSansPro";
            src: url({{ asset('fonts/SourceSansPro-Regular.ttf') }});
        }
        @font-face {
            font-family: "KanitRegular";
            src: url({{ asset('fonts/Kanit-Regular.ttf') }});
        }
        @font-face {
            font-family: "RubikRegular";
            src: url({{ asset('fonts/Rubik-Regular.ttf') }});
        }
        @font-face {
            font-family: "RubikPixelsRegular";
            src: url({{ asset('fonts/RubikPixels-Regular.ttf') }});
        }
        @font-face {
            font-family: "Grotes";
            src: url({{ asset('fonts/GetVoIPGrotesque.ttf') }});
        }
        * {
            box-sizing: border-box;
        }
        html,
        body {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: var(--text-color);
            background-color: var(--background-color);
        }

    </style>
    <body>
        <div class="mn_wrpr">
            {{ $slot }}
        </div>
    </body>
</html>
