<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use Illuminate\Http\Request;

class AdminAuthorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize("isAdmin");

        $books = Books::all();

        return view("dashboard.authors.index",[
            "authors" => Authors::all(),
            "books" => $books
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.authors.create");
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
            "name" => "required|max:255",
            "slug" => "required",
            "region" => "required"
        ];

        $validatedData = $request->validate($rules);
        
        // $validatedData["id"] = $category[0]->id;
        
        Authors::create($validatedData);

        return redirect("/dashboard/authors")->with("success", "New author has been provided publicly !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $author = Authors::find($id);

        return view("dashboard.authors.edit", [
            "author" => $author
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
        $author = Authors::find($id);

        $rules = [
            "name" => "required|max:255",
            "region" => "required",
            "slug" => "required"
        ];

        $validatedData = $request->validate($rules);
        
        $validatedData["id"] = $author->id;
        
        Authors::find($id)->update($validatedData);

        return redirect("/dashboard/authors")->with("success", "[ $author->name ] has been updated publicly !");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $author = Authors::find($id);

        $affected_books = Books::where("author_id", $id)->get();
        $total_affected_books = $affected_books->count();
        
        if ($total_affected_books > 0) {
            return redirect("/dashboard/authors")->with("failed", "There are $total_affected_books book(s) written by [ $author->name ] , can't delete this item !");
        }

        Authors::destroy($author->id);

        return redirect("/dashboard/authors")->with("warning", "[ $author->name ] has been deleted !");
    }
}
