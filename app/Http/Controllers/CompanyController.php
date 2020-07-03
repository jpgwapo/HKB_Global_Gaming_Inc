<?php

namespace App\Http\Controllers;

use App\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $res = Company::paginate(10);

        return view('company.index',['results' => $res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'bail|required|unique:companies|max:255',
            'email' => 'required|email|unique:companies',
            'logo' => 'required|image|mimes:jpeg,png,jpg|dimensions:max_width=100,max_height=100',
            'website' => 'required',
        ]);

        $name = $request->name;
        $email = $request->email;
        $logo = $request->file('logo');
        $website = $request->website;

        $rules = ['image_path' => 'required|image|mimes:jpeg,png,jpg'];
        $file_name = $name . "_" . rand(1, 80) . '.jpg';
        $logo->move(public_path('/images'), $file_name);

        Company::create(
            [
                'name' =>  $name, 
                'email' => $email,
                'logo' => $file_name,
                'website' => $website,
            ]
        );

        return redirect()->route('company')->with('status', 'Company saved!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, $id)
    {
        $res = Company::firstWhere('id', $id);

        return view('company.edit', ['result' => $res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $this->validate($request,[
            'name' => 'required|max:20',
            'email' => 'required|max:30',
            'logo' => 'image|mimes:jpeg,png,jpg|dimensions:max_width=100,max_height=100',
            'website' => 'required|max:30',
        ]);

        $id = $request->id;
        $name = $request->name;
        $email = $request->email;
        $logo = $request->file('logo');
        $website = $request->website;

        $rules = ['image_path' => 'required|image|mimes:jpeg,png,jpg'];
        $file_name = $name . "_" . rand(1, 80) . '.jpg';
        $logo->move(public_path('/images'), $file_name);

        Company::where('id', $id)->update(['name' => $name, 'email' => $email, 'logo' => $file_name, 'website' => $website]);

        return redirect()->route('company')->with('status', 'Company updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Company  $company, $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company, $id)
    {
        Company::where('id', $id)->delete();
        return redirect()->route('company')->with('status', 'Company deleted!');
    }
}
