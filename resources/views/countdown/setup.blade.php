@extends('layouts.app')

@section('content')
    <div class="flex space-x-5" x-data="timer()" x-init="start()">
        <div class="w-3/5">
            <div class="text-sm tracking-wide uppercase text-gray-600">Timer Preview</div>
            <div class="p-4 rounded-sm bg-gray-700 mt-1">
                <div class="text-white font-londrina" x-text="timeRemaining()" :style="fontSize()"></div>
            </div>
            
            <div class="text-sm tracking-wide uppercase text-gray-600 mt-8">Ended Text Preview</div>
            <div class="p-4 rounded-sm bg-gray-700 mt-1">
                <div class="text-white font-londrina" x-text="endedText" :style="fontSize()"></div>
            </div>
        </div>
        <div class="w-2/5">
            <div class="flex space-x-4">
                <div>
                    <label class="block text-sm tracking-wide uppercase text-gray-600">Duration in Minutes</label>
                    <input type="text" name="duration" x-model="durationInMinutes" class="w-full h-12 px-5 mt-1 text-gray-300 focus:text-gray-200 bg-gray-600 text-xl font-mono focus:bg-gray-500 rounded-sm">
                </div>
    
                <div>
                    <label class="block text-sm tracking-wide uppercase text-gray-600">Text Size in Pixels</label>
                    <input type="text" name="size" x-model="size" class="w-full h-12 px-5 mt-1 text-gray-300 focus:text-gray-200 bg-gray-600 text-xl font-mono focus:bg-gray-500 rounded-sm">
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm tracking-wide uppercase text-gray-600">Timer Ended Text</label>
                <input type="text" name="endedText" x-model="endedText" class="w-full h-12 px-5 mt-1 text-gray-300 focus:text-gray-200 bg-gray-600 text-xl font-mono focus:bg-gray-500 rounded-sm">
            </div>

            <div class="mt-4 text-right">
                <a href="{{ route('countdown.timer') }}" class="inline-block px-4 py-2 rounded-sm bg-primary-500 text-gray-800 transition duration-150 hover:shadow-lg hover:bg-primary-400 hover:text-gray-200 transform hover:-translate-y-px">Copy URL</a>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
   <script>
        function timer() {
            return {
                durationInMinutes: 5,
                duration: null,
                countdown: null,
                size: 96,
                endedText: 'About to start!',
                fontSize() {
                    return 'font-size: ' + this.size + 'px'
                },
                start() {
                    this.duration = this.durationInMinutes * 60 * 1000

                    this.countdown = setInterval(() => {
                        if (this.timeEnded()) {
                            clearInterval(this.countdown)
                            return
                        }

                        this.duration -= 1000
                    }, 1000)
                },
                timeEnded() {
                    return this.duration <= 0
                },
                timeRemaining() {
                    if (this.timeEnded()) {
                        return this.endedText
                    }
                    var minutes = Math.floor(this.duration / 60000);
                    var seconds = ((this.duration % 60000) / 1000).toFixed(0);
                    return minutes + ":" + (seconds < 10 ? '0' : '') + seconds;
                }
            }
        }
   </script>
@endpush
