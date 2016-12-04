@extends('layouts.app')

@section('content')

    <notebook-show v-bind:notebook="{{ $notebook }}"></notebook-show>

@endsection
