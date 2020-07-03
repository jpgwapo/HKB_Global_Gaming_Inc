<?php

namespace App\Http\Controllers;

use App\Employee;
use App\Company;
use Illuminate\Http\Request;

class EmployeeController extends Controller
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
        $res = Employee::select('employees.id', 'first_name', 'last_name', 'company_id', 'employees.email', 'employees.updated_at', 'phone', 'companies.name')
                ->join('companies', 'companies.id', '=', 'employees.company_id')->paginate(10);

        return view('employee.index',['results' => $res]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companyName = Company::select('name', 'id')->get();

        return view('employee.create', ['companies' => $companyName]);
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
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'company_id' => 'required',
            'email' => 'required|email|unique:employees|max:40',
            'phone' => 'required|max:30',
        ]);

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $company_id = $request->company_id;
        $email = $request->email;
        $phone = $request->phone;

        Employee::create(
            [
                'first_name' => $first_name,
                'last_name' => $last_name,
                'company_id' => $company_id,
                'email' => $email,
                'phone' => $phone,
            ]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee, $id)
    {
        $res = Employee::firstWhere('id', $id);
        $companyName = Company::select('name', 'id')->get();

        return view('employee.edit', ['result' => $res, 'companies' => $companyName]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $this->validate($request,[
            // 'name' => 'bail|required|unique:companies|max:255',
            // 'email' => 'required|email|unique:companies',
            'logo' => 'image|mimes:jpeg,png,jpg|dimensions:max_width=100,max_height=100',
            // 'website' => 'required',
        ]);

        $id = $request->id;
        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $company_id = $request->company_id;
        $email = $request->email;
        $phone = $request->phone;

        Employee::where('id', $id)->update([
            'first_name' => $first_name,
            'last_name' => $last_name,
            'company_id' => $company_id,
            'email' => $email,
            'phone' => $phone,
        ]);

        return redirect()->route('employee')->with('status', 'Company updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee, $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, $id)
    {
        Employee::where('id', $id)->delete();
        return redirect()->route('company')->with('status', 'Employee deleted!');
    }
}
