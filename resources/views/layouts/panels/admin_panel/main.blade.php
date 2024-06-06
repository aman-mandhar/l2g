@extends('layouts.panels.admin_panel.dashboard')
@section('content')
    <div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
        @livewire('report')  
@endsection