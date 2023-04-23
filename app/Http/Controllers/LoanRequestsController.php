<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Loans;
use Carbon\Carbon;
use Illuminate\Http\Request;

class LoanRequestsController extends Controller
{
    public function index() {
        $pickup_deadline = Carbon::tomorrow();
        $return_deadline = Carbon::today()->addDays(7);

        return view("dashboard.request.index", [
            "loans" => Loans::latest()->get(),
            "pickup_deadline" => $pickup_deadline,
            "return_deadline" => $return_deadline
        ]);
    }

    public function accept(Loans $loans) {
        Loans::where("id", $loans->id)->update(["acceptance_status" => 1]);
        
        $target_book = Books::where("id", $loans->book_id)->get();
        Books::where("id", $loans->book_id)->update(["total_units" => $target_book[0]->total_units -= 1]);
        
        return redirect("/dashboard/requests")->with("success", "A request was accepted !");
    }

    public function reject(Loans $loans) {
        Loans::where("id", $loans->id)->update(["acceptance_status" => 0]);
        return redirect("/dashboard/requests")->with("warning", "A request was rejected !");
    }

    public function cancel(Loans $loans) {
        $loan_limit = Loans::where("user_id", $loans->user->id)->where('acceptance_status', '!=' , 0)->orWhereNull('acceptance_status')->get()->count();
        
        if($loans->acceptance_status === 0) {
            if($loan_limit < 2) {
                Loans::where("id", $loans->id)->update(["acceptance_status" => NULL]);
                return redirect("/dashboard/requests")->with("success", "A request was cancelled !");
            }
            return redirect("/dashboard/requests")->with("failed", "The user has selected another book !");
        }

        $target_book = Books::where("id", $loans->book_id)->get();
        Books::where("id", $loans->book_id)->update(["total_units" => $target_book[0]->total_units += 1]);

        Loans::where("id", $loans->id)->update(["acceptance_status" => NULL]);
        return redirect("/dashboard/requests")->with("warning", "A request was cancelled !");
    }

    public function done(Loans $loans) {
        Loans::where("id", $loans->id)->update(["acceptance_status" => 2]);

        $target_book = Books::where("id", $loans->book_id)->get();
        Books::where("id", $loans->book_id)->update(["total_units" => $target_book[0]->total_units += 1]);
        
        return redirect("/dashboard/requests")->with("success", "A request was marked as done !");
    }
}
