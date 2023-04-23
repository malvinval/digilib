<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Comments;
use App\Models\Likes;
use App\Models\Loans;
use App\Models\User;
use Illuminate\Http\Request;

use function Symfony\Component\String\b;

class DashboardProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $current_loans = Loans::where("user_id", auth()->user()->id)->where("acceptance_status", 1)->count();
        $total_loans = Loans::where("user_id", auth()->user()->id)->where("acceptance_status", 2)->count();
        
        return view("dashboard.profile.index", [
            "current_loans" => $current_loans,
            "total_loans" => $total_loans
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    
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
    public function edit()
    {
        

        return view("dashboard.profile.edit");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $validatedData = $request->validate([
            "studentID_image" => "required|file|max:2024"
        ]);

        if($request->name != auth()->user()->name) {
            $validatedData["name"] = 'required|max:255|unique:users';
        }

        if($request->username != auth()->user()->username) {
            $validatedData["username"] = 'required|max:255|unique:users';
        }
        
        if($request->file("studentID_image")) {
            $validatedData["studentID_image"] = $request->file("studentID_image")->store("studentID_image/" . auth()->user()->id);
        }
        
        User::where("id", auth()->user()->id)->update($validatedData);
        
        return redirect("/dashboard/profile");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
