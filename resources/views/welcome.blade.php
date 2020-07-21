<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Stream Tools</title>
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    </head>
    <body class="bg-gray-800">
        <div x-data="timer()" x-init="start()">
            <div class="text-white text-6xl font-londrina" x-text="timeRemaining()"></div>
        </div>
        <script src="{{ mix('js/app.js') }}"></script>
        <script>
            function timer() {
                return {
                    duration: 5,
                    countdown: null,
                    start() {
                        this.duration = this.duration * 60 * 1000

                        this.countdown = setInterval(() => {
                            if (this.duration <= 0) {
                                clearInterval(this.countdown)
                                return
                            }

                            this.duration -= 1000
                        }, 1000)
                    },
                    timeRemaining() {
                        var minutes = Math.floor(this.duration / 60000);
                        var seconds = ((this.duration % 60000) / 1000).toFixed(0);
                        return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
                    }
                }
            }
        </script>
    </body>
</html>
