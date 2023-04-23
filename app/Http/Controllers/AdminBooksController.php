<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Loans;
use Illuminate\Http\Request;

class AdminBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.books.index", [
            "books" => Books::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.books.create", [
            "categories" => Categories::all(),
            "authors" => Authors::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            "title" => "required|max:255",
            "author_id" => "required|max:255",
            "slug" => "required|unique:books",
            "publisher" => "required|max:255",
            "published_at" => "required|max:4",
            "isbn" => "required",
            "total_pages" => "required",
            "total_units" => "required",
            "category_id" => "required",
            "body" => "required",
        ]);

        if($request->file("book_image")) {
            $validatedData["book_image"] = $request->file("book_image")->store("books_image/" . $request["title"]);
        }
        
        Books::create($validatedData);

        return redirect("/dashboard/books")->with("success", "A new book has been provided publicly !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $book = Books::find($id);

        return view("dashboard.books.show", [
            "book" => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Books::find($id);

        return view("dashboard.books.edit", [
            "book" => $book,
            "authors" => Authors::all(),
            "categories" => Categories::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $book = Books::find($id);

        $rules = [
            "title" => "required|max:255",
            "author_id" => "required",
            "category_id" => "required",
            "body" => "required",
            "publisher" => "required",
            "published_at" => "required",
            "isbn" => "required",
            "total_pages" => "required",
            "total_units" => "required"
        ];

        if($request->slug != $book->slug) {
            $rules["slug"] = 'required|unique:books';
        }

        $validatedData = $request->validate($rules);
        
        $validatedData["id"] = $book->id;
        
        Books::find($id)->update($validatedData);

        return redirect("/dashboard/books")->with("success", "[ $book->title ] has been updated publicly !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $book = Books::find($id);
        $affected_loan = Loans::where("book_id", $id)->get();
    
        Books::destroy($book->id);
        Loans::destroy($affected_loan);

        return redirect("/dashboard/books")->with("warning", "[ $book->title ] has been deleted permanently !");
    }
}
