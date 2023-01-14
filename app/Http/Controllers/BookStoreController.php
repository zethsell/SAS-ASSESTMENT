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
        $round = BookStore::create($request->validated());
        return new BookStoreResource($round);
    }

    public function show(BookStore $bookStore)
    {
        $newRound = BookStore::whereId($bookStore->id)->with('statistic')->first();
        return new BookStoreResource($newRound);
    }

    public function update(BookStoreRequest $request, BookStore $bookStore)
    {
        $bookStore->fill($request->validated());
        $bookStore->save();
        return new BookStoreResource($bookStore);
    }

    public function destroy(BookStore $bookStore)
    {
        $bookStore->delete();
        return response()->noContent();
    }
}
