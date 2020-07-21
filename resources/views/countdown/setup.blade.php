@extends('layouts.app')

@section('content')
    <form action="{{ route('countdown.show') }}" method="GET">
        <div class="flex space-x-5" x-data="timer()" x-init="start()">
            <div class="w-3/5">
                <div class="text-sm tracking-wide uppercase text-gray-600">Timer Preview</div>
                <div class="p-4 rounded-sm bg-gray-700 mt-1">
                    @include('countdown.timer')
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
                        <input type="text" name="minutes" x-model="minutes" class="w-full h-12 px-5 mt-1 text-gray-300 focus:text-gray-200 bg-gray-600 text-xl font-mono focus:bg-gray-500 rounded-sm">
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
                    <button class="inline-block px-4 py-2 rounded-sm bg-primary-500 text-gray-800 transition duration-150 hover:shadow-lg hover:bg-primary-400 hover:text-gray-200 transform hover:-translate-y-px">Copy URL</button>
                </div>
            </div>
        </div>
    </form>
@endsection


