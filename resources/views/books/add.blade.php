@extends('layouts.navbar')

@section('content')
<h1 class="text-3xl font-bold mb-6">Tambah Buku Baru</h1>
<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="bg-white p-8 rounded-lg shadow-md">
    @csrf
    @include('books.partials.form-fields')
</form>
@endsection