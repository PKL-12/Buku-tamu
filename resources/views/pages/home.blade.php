@extends('layouts.app')

@section('title', 'Buku Tamu')

@section('content')

<div id="wrapper">
    <div id="content-wrapper" class="d-flex flex-column">

        <div id="content">

            {{-- Topbar --}}
            @include('pages.partials.topbar')

            {{-- Main Content --}}
            <div class="container-fluid">

                {{-- Dashboard Widgets --}}
                @include('pages.partials.dashboard-widgets')


            </div>

        </div>        

    </div>
</div>

@endsection
