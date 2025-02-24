@extends('base')
@section('react')
    @vitereactrefresh
    @vite(['resources/js/react/index.jsx'])
@endsection
@section('title', 'Bon de Livraison')
@section('bodyTitle', 'Bon De Livaison')

@section('body')
    <div id="react-root"></div>
@endsection
