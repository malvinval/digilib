<?php

namespace App\Http\Controllers;

use App\Models\Authors;
use App\Models\Books;
use App\Models\Categories;
use App\Models\Comments;
use App\Models\Developers;
use App\Models\Likes;

use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index() {
        return view("index", [
            "name" => env("APP_NAME"),
            "pageName" => "Home"
        ]);
    }

    public function books() {
        return view("books", [
            "name" => env("APP_NAME"),
            "pageName" => "Books",
            "books" => Books::latest()->filter(request(["search", "category", "author"]))->paginate(6)->withQueryString(),
            "authors" => Authors::all(),
        ]);
    }

    public function book(Books $books) {
        $liked = Likes::where('book_id', '=', $books->id)->where('liker', '=', auth()->user()->username )->get()->count();
        $likes_total = Likes::where('book_id', $books->id)->get()->count();

        $comments = Comments::where("book_id", $books->id)->get();

        return view("book", [
            "name" => $books->author->name,
            "pageName" => $books->title,
            "title" => $books->title,
            "slug" => $books->slug,
            "body" => $books->body,
            "book_image" => $books->book_image,
            "category_name" => $books->category->name,
            "author_name" => $books->author->name,
            "publisher" => $books->publisher,
            "publication_year" => $books->published_at,
            "total_pages" => $books->total_pages,
            "total_units" => $books->total_units,
            "liked" => $liked,
            "likes_total" => $likes_total,
            "comments" => $comments
        ]);
    }

    public function categories() {
        return view("categories", [
            "name" => env("APP_NAME"),
            "pageName" => "Categories",
            "categories" => Categories::all()
        ]);
    }

    public function likes(Books $books) {
        $liked = Likes::where('book_id', '=', $books->id)->where('liker', '=', auth()->user()->username )->get()->count();

        if ($liked == 0) {
            Likes::create([
                "book_id" => $books->id,
                "liker" => auth()->user()->username
            ]);
        } else {
            Likes::where('book_id', '=', $books->id)->where('liker', '=', auth()->user()->username )->delete();
        }

        $updater_likes = Likes::where('book_id', '=', $books->id)->get()->count();

        Books::where("id", "=", $books->id)->update(["likes" => $updater_likes]);

        return redirect("/books/$books->slug");
    }

    public function comments(Request $request, Books $books) {
        $request->validate([
            "body" => "required"
        ]);

        Comments::create([
            "user_id" => auth()->user()->id,
            "book_id" => $books->id,
            "body" => $request->body
        ]);

        $updater_comments = Comments::where('book_id', '=', $books->id)->get()->count();
        Books::where("id", "=", $books->id)->update(["comments" => $updater_comments]);

        return redirect("/books/$books->slug")->with("success", "Your comment has been uploaded publicly !");
    }

    public function developers() {
        return view("developer",[
            "name" => env("APP_NAME"),
            "pageName" => "Developers",
            "developers" => Developers::all()
        ]);
    }
}
