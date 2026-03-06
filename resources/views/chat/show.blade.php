@extends('layouts.app')
@section('content')
<h1 class="text-2xl font-semibold mb-4">Chat com {{ $other->name }}</h1>
<x-chatbox :messages="$messages" :userId="auth()->id()" action="{{ route('chat.store',$other->id) }}" />
@endsection