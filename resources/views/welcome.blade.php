@extends('layouts.app')
@section('content')
    @livewire('product-widget',['name' => 1])
    @livewire('books-catlogs')
@endsection
