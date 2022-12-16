<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::with('author')->get();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $author = Author::all();
        return view('books.create', compact('author'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'judul' => 'required',
            'halaman' => 'required|numeric|min:0|max:350',
            'kategori' => 'required',
            'penerbit' => 'required',
            'author_id' => 'required'
        ];

        $validated = $request->validate($rules);

        Book::create($validated);

        $book = new Book;
        $book->judul = $request->judul;
        $book->author_id = $request->author_id;

        $request->session()->flash('success', "Sukses menambahkan buku baru yang berjudul {$validated['judul']}");
        return redirect()->route('books.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $author = Author::all();
        return view('books.edit', compact('book', 'author'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $rules = [
            'judul' => 'required|max:200',
            'halaman' => 'required|numeric|min:0|max:350',
            'kategori' => 'required|max:50',
            'penerbit' => 'required|max:100',
            'author_id' => 'required'
        ];

        $validated = $request->validate($rules);

        $book->update($validated);

        $book->judul = $request->judul;
        $book->author_id = $request->author_id;

        $request->session()->flash('success', "Sukses memperbarui data buku yang berjudul {$validated['judul']}");
        return redirect()->route('books.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', "Sukses menghapus data buku {$book['judul']}");
    }

}
