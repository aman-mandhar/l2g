@extends('layouts.panels.admin_panel.dashboard')
@section('content')
@include('layouts.panels.admin_panel.navbar')
<div class="container">
    <div class="container">
        @livewire('token-balance')
        @livewire('ref-detail')
    
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                        <table>
                            <tr>
                                <td>
                                    <a href="{{ route('redeem.create') }}">Redeem Tokens</a>
                                </td>
                                <td>
                                    <a href="{{ route('sales.quickuser') }}">Create New Refferal</a>
                                </td>
                            </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>
@endsection