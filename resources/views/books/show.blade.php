@extends('layouts.master')

@section('title', $book->judul)

@section('content')
    <div class="col-md-12">
        <div class="row">
            <div class="col-8">
                <h2>{{ $book->judul }}</h2>
            </div>
            <div class="col-4">
                <div class="float-right">
                    <div class="btn-group" role="group">
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-primary ml-3">Edit</a>

                        <form action={{ route('books.destroy', $book->id) }} method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ml-3">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <h5>
            <span class="badge badge-primary">
                <i class="fa fa-star fa-fw"></i>
                {{ $book->halaman }}
            </span>
        </h5>
        <hr>
        <p class="lead">{{ $book->kategori }}</p>
        <p class="lead">{{ $book->penerbit }}</p>
        <p class="lead">{{ $book->author_id }}</p>
    </div>
@endsection
