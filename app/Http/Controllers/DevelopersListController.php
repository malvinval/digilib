<?php

namespace App\Http\Controllers;

use App\Models\Developers;
use Illuminate\Http\Request;

class DevelopersListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("dashboard.developers.index", [
            "developers" => Developers::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $regions = file_get_contents(base_path() . "/regions.json");
        $regions = json_decode($regions, true);

        return view("dashboard.developers.create", [
            "regions" => $regions
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
            "name" => "required|max:255",
            "role" => "required|max:255",
            "region" => "required",
            "instagram_link" => "unique:developers",
            "github_link" => "unique:developers",
            "email_link" => "unique:developers",
            "dev_photo" => "required|file|image|max:2024",
        ]);

        $validatedData["region"] = strtolower($validatedData["region"]);

        if($request->file("dev_photo")) {
            $validatedData["dev_photo"] = $request->file("dev_photo")->store("dev_photo/" . $request["name"]);
        }
        
        Developers::create($validatedData);

        return redirect("/dashboard/developers")->with("success", "New developer has been listed !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $developer = Developers::find( $id );

        return view("dashboard.developers.show", [
            "developer" => $developer,
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
        $developer = Developers::find( $id );
        $regions = file_get_contents(base_path() . "/regions.json");
        $regions = json_decode($regions, true);

        return view("dashboard.developers.edit", [
            "developer" => $developer,
            "regions" => $regions
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
        $developer = Developers::find( $id );

        $rules = [
            "name" => "required|max:255",
            "role" => "required",
            "region" => "required",
            "instagram_link" => "required",
            "github_link" => "required",
            "email_link" => "required",
        ];

        $rules["region"] = strtolower($rules["region"]);
        $validatedData = $request->validate($rules);
        
        Developers::find( $id )->update($validatedData);

        return redirect("/dashboard/developers")->with("success", "[ $developer->name ] has been updated publicly");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $developer = Developers::find( $id )->get();

        Developers::destroy($developer);

        return redirect("/dashboard/developers")->with("warning", "[ $developer->name ] has been removed !");
    }
}
