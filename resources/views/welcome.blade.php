@extends('layouts.main')

@section('title', 'HDC Events')

@section('content')

<h1>Blade</h1>
<img src="/img/banner.jpg" alt="banner">

{{-- Condição --}}
@if($nome == 'Gabriele')
    <p>{{ $nome }} tem {{ $idade }} anos, e trabalha como {{ $profissao }}.</p><br>
@endif

{{-- Repetição com for --}}
@for($i = 0; $i < count($array); $i++) 
    <p>{{ $array[$i] }}</p>
@endfor

<br>

{{-- Repetição com foreach --}}
@foreach($nomes as $nome)
    <p>{{ $loop->index }}</p>
    <p>{{ $nome }}</p>
@endforeach

@endsection