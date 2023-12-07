<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function rules(){
        return [
            'first_name' => 'required|max:20',
            'last_name' => 'required|max:20',
            'email' => 'required|email',
            'phone' => 'required|size:10',
            'company_id' => 'required|exists:companies,id',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::paginate(10);
        return view('employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::get();
        return view('employees.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), $this->rules(), [
            'first_name.required' => 'Enter Your First Name',
            'last_name.required' => 'Enter Your Last Name',
            'first_name.max' => 'First Name Should Not be greater than 20 letter',
            'last_name.max' => 'Last Name Should Not be greater than 20 letter',
            'email.required' => 'Enter Your Email',
            'email.email' => 'Invalid Email Address',
            'phone.required' => 'Enter Your Phone',
            'phone.size' => 'Phone Should be 10 numbers',
            'company_id.required' => 'Choose Company',
            'company_id.exists' => 'Company Name Not Exists',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('employees.create')
                ->withInput($request->all())
                ->withErrors($validator->errors()->messages());
        }

        $employee = new Employee();
        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->company_id = $request->company_id;
        $employee->save();

        return redirect()->route('employees.index');
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
        $employee = Employee::findOrFail($id);
        $companies = Company::get();

        if (!$employee) {
            return redirect()->route('employees.index');
        }
        return view('employees.edit', compact('employee', 'companies'));
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
        $validator = Validator::make($request->all(), $this->rules(), [
            'first_name.required' => 'Enter Your First Name',
            'last_name.required' => 'Enter Your Last Name',
            'first_name.max' => 'First Name Should Not be greater than 20 letters',
            'last_name.max' => 'Last Name Should Not be greater than 20 letters',
            'email.required' => 'Enter Your Email',
            'email.email' => 'Invalid Email Address',
            'phone.required' => 'Enter Your Phone',
            'phone.size' => 'Phone Should be 10 numbers',
            'company_id.required' => 'Choose Company',
            'company_id.exists' => 'Company Name Not Exists',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('employees.edit', ['employee' => $id])
                ->withInput($request->all())
                ->withErrors($validator->errors()->messages());
        }

        $employee = Employee::findOrFail($id);

        if (!$employee) {
            return redirect()->route('employees.edit');
        }

        $employee->first_name = $request->first_name;
        $employee->last_name = $request->last_name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->company_id = $request->company_id;
        $employee->save();

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::findOrFail($id);

        if (!$employee) {
            return redirect()->route('employees.index');
        }

        $employee->delete();

        return redirect()->route('employees.index');
    }
}
