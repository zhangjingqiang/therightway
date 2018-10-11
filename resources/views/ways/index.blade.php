@extends('layouts.default')
@section('content')
    @foreach ($ways as $way)
        <div class="alert alert-success" role="alert">
            <a href="{{ $way->site }}">{{ $way->name }}</a>
        </div>
    @endforeach
@stop
