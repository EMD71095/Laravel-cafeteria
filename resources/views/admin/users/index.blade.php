@extends('layouts.app')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Lista de usuarios</h1>
@stop

@section('content')
    @livewire('admin.user-index')
@endsection
