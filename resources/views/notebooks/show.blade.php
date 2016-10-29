@extends('layouts.app')

@section('content')

    <notebook-show notebook-uid="{{ $notebook->uid }}" notebook-title="{{ $notebook->title }}"></notebook-show>

@endsection
