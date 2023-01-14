<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookStoreRequest;
use App\Http\Resources\BookStoreResource;
use App\Models\BookStore;

class BookStoreController extends Controller
{
    public function index()
    {
        return BookStoreResource::collection(BookStore::all());
    }

    public function store(BookStoreRequest $request)
    {
        $book = BookStore::create($request->validated());
        return new BookStoreResource($book);
    }

    public function show(BookStore $book)
    {
        $newBook = BookStore::whereId($book->id)->first();
        return new BookStoreResource($newBook);
    }

    public function update(BookStoreRequest $request, BookStore $book)
    {
        $book->fill($request->validated());
        $book->save();
        return new BookStoreResource($book);
    }

    public function destroy(BookStore $book)
    {
        $book->delete();
        return response()->noContent();
    }
}
