@extends('layouts.app')

@section('content')
    <div x-data="timer()" x-init="start()">
        <form action="{{ route('countdown.show') }}" method="GET" @submit.prevent="copyUrl()" x-ref="timerForm">
            <div class="flex space-x-5">
                <div class="w-3/5">
                    <div class="text-sm tracking-wide uppercase text-gray-600">Timer Preview</div>
                    <div class="p-4 rounded-sm bg-gray-700 mt-1">
                        @include('countdown.timer')
                    </div>
                    
                    <div class="text-sm tracking-wide uppercase text-gray-600 mt-8">Ended Text Preview</div>
                    <div class="p-4 rounded-sm bg-gray-700 mt-1">
                        <div class="text-white font-londrina" x-text="endedText" :style="getStyles()"></div>
                    </div>
                </div>
                <div class="w-2/5">
                    <div class="flex space-x-4">
                        <div class="flex-1">
                            <label class="block text-sm tracking-wide uppercase text-gray-600">Duration in Minutes</label>
                            <input type="text" name="minutes" x-model="minutes" class="w-full h-12 px-5 mt-1 text-gray-300 focus:text-gray-200 bg-gray-600 text-xl font-mono focus:bg-gray-500 rounded-sm">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm tracking-wide uppercase text-gray-600">Text Size in Pixels</label>
                            <input type="text" name="size" x-model="size" class="w-full h-12 px-5 mt-1 text-gray-300 focus:text-gray-200 bg-gray-600 text-xl font-mono focus:bg-gray-500 rounded-sm">
                        </div>
                        <div class="flex-1">
                            <label class="block text-sm tracking-wide uppercase text-gray-600">Text Color</label>
                            <input type="color" name="textColor" x-model="textColor" class="w-full h-12 px-5 mt-1 text-gray-300 focus:text-gray-200 bg-gray-600 text-xl font-mono focus:bg-gray-500 rounded-sm">
                        </div>
                    </div>
        

                    <div class="mt-4">
                        <label class="block text-sm tracking-wide uppercase text-gray-600">Timer Ended Text</label>
                        <input type="text" name="endedText" x-model="endedText" class="w-full h-12 px-5 mt-1 text-gray-300 focus:text-gray-200 bg-gray-600 text-xl font-mono focus:bg-gray-500 rounded-sm">
                    </div>

                    <div class="mt-4 text-right">
                        <span x-show="copied" 
                            x-transition:enter="transition ease-out duration-300"
                            x-transition:enter-start="opacity-0 transform scale-90"
                            x-transition:enter-end="opacity-100 transform scale-100"
                            x-transition:leave="transition ease-in duration-300"
                            x-transition:leave-start="opacity-100 transform scale-100"
                            x-transition:leave-end="opacity-0 transform scale-90"
                            class="inline-block mr-4 text-primary-500 italic"
                        >Copied!</span>
                        <button id="copy-btn" class="inline-block px-4 py-2 rounded-sm bg-primary-500 text-gray-900 transition duration-150 hover:shadow-lg hover:bg-primary-400 hover:text-gray-200 transform hover:-translate-y-px">Copy URL</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection



