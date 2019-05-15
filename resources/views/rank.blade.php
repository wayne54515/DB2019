@extends('layouts.default')

@section('content')
    {{-- <p>{{ Auth::user()->id }}</p> --}}
    @if (Auth::guest())
    <rank user_id=0></rank>
    @else
    <rank user_id={{Auth::user()->id}}></rank>
    @endif
@endsection