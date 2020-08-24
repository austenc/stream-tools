@extends('layouts.app')

@section('content')
    <div class="absolute top-0 left-0 w-full h-full" x-data="animate()" x-init="init()">
        <template x-for="(rocket, index) in rockets" :key="index">
            <div :style="transformByIndex(index)" :class="{ 'translate-rocket': animating }" class="absolute flex items-end bottom-0 left-0 text-5xl translate translate-y-full transition-all duration-500 ease-in transform">
                🚀
            </div>
        </template>

        <div class="m-5">
            <button @click="launch()" class="absolute z-20 bg-primary-500 text-white p-4 rounded transition-all duration-700 hover:bg-primary-200 hover:text-primary-800">Launch!</button>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // To Do:
        // - Randomize X / Y positioning using negatives and a mod of a random value
        // - Export and publish this, and use it on the stream

        function animate() {
            return {
                animating: false,
                rockets: [],
                transformByIndex(index) {
                    return 'left: ' + 100 * index + 'px;'
                        + 'transition-delay: ' + 500 * index + 'ms'
                },
                launch() {
                    this.rockets = Array.from({length: Math.floor(Math.random() * 10) + 1}, () => { return 1 })
                    this.animating = !this.animating
                },
                init() {
                    let twitch = new tmi.Client({
                        options: { debug: true },
                        connection: {
                            secure: true,
                            reconnect: true,
                        },
                        identity: {
                            username: '{{ config('services.twitch.username') }}',
                            password: '{{ config('services.twitch.password') }}',
                        },
                        channels: ['{{ config('services.twitch.channel') }}'],
                    })
                    twitch.connect()
            
                    twitch.on('message', (channel, tags, message, self) => {
                        // Ignore echoed messages.
                        if(self) return;
            
                        if (message.toLowerCase() === '!launch') {
                            // twitch.say(channel, `@${tags.username}, heya!`);
                            this.animating = !this.animating
                        }
                    });
                }
            }
        }
    </script>
@endpush