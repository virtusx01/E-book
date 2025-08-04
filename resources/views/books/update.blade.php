@extends('layouts.navbar')

@section('content')
<h1 class="text-3xl font-bold mb-6">Edit Buku: {{ $book->title }}</h1>
<form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
    @csrf
    @method('PUT')
    @include('books.partials.form-fields', ['book' => $book])
</form>
@endsection