@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Conversas</h1>
<x-chatlist :conversations="$conversations" />
@endsection