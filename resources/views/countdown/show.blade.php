@extends('layouts.widget')
@section('content')
    <div x-data="timer()" x-init="start()">
        @include('countdown.timer')
    </div>
@endsection

