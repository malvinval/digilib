<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Loans;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardLoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans = Loans::where("user_id", auth()->user()->id)->latest()->get();
        $pickup_deadline = Carbon::tomorrow();
        $return_deadline = Carbon::today()->addDays(7);

        return view("dashboard.loans.index", [
            "loans" => $loans,
            "pickup_deadline" => $pickup_deadline,
            "return_deadline" => $return_deadline
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("dashboard.loans.create", [
            "books" => Books::all()
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
        $loan_limit = Loans::where("user_id", auth()->user()->id)->where('acceptance_status', '!=' , 0)->where('acceptance_status', '!=' , 2)->orWhereNull('acceptance_status')->get()->count();
        $target_book_stock = Books::where("id", $request->book_id)->get();

        if($target_book_stock[0]->total_units === 0) {
            return redirect("/dashboard/loan/create")->with("failed", "This book is out of stock !");
        }

        if(!auth()->user()->studentID_image) {
            return redirect("/dashboard/loan/create")->with("failed", "Please upload your Student ID File to borrow a book");
        }

        if($loan_limit < 2) {
            $validatedData = $request->validate([
                "book_id" => "required",
                "studentId" => "required|max:255",
                "body" => "required"
            ]);
    
            // if($request->file('image')) {
            //     $validatedData["image"] = $request->file("image")->store('blogs-image');
            // }
    
            $validatedData["user_id"] = auth()->user()->id;
            
            Loans::create($validatedData);
    
            return redirect("/dashboard/loan")->with("success", "Loan request was sent !");
        }

        return redirect("/dashboard/loan/create")->with("failed", "You can only borrow 2 books in one period !");
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loan = Loans::where( "id", $id )->get();
        Loans::destroy($loan);

        return redirect("/dashboard/loan")->with("success", "A request has been cancelled !");
    }
}
