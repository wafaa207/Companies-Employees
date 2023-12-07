<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class CompanyController extends Controller
{

    public function rules(){
        return [
            'company_name' => 'required|max:20',
            'company_email' => 'required|email',
            'company_image' => 'required|image|mimes:jpeg,png,jpg'
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('companies.create');
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
            'company_email.required' => 'Enter Your Email Address',
            'company_email.email' => 'Invalid Email Address',
            'company_name.required' => 'Enter Your Company Name',
            'company_name.max' => 'Company Name Should Not be Greater than 20 letters',
            'company_image.required' => 'Choose Company Image',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('companies.create')
                ->withInput($request->all())
                ->withErrors($validator->errors()->messages());
        }

        $company = new Company();
        $company->name = $request->company_name;
        $company->email = $request->company_email;

        if ($request->hasFile('company_image')) {
            $imagePath = $request->file('company_image')->store('public/companies');
            $company->logo = Storage::url($imagePath);
        }
        $company->save();

        return redirect()->route('companies.index');
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
        $company = Company::findOrFail($id);

        if (!$company) {
            return redirect()->route('companies.index');
        }

        return view('companies.edit', compact('company'));
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
            'company_email.required' => 'Enter Your Email Address',
            'company_email.email' => 'Invalid Email Address',
            'company_name.required' => 'Enter Your Company Name',
            'company_name.max' => 'Company Name Should Not be Greater than 20 letters',
            'company_image.required' => 'Choose Company Image',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('companies.edit', ['company' => $id])
                ->withInput($request->all())
                ->withErrors($validator->errors()->messages());
        }

        $company = Company::findOrFail($id);

        if (!$company) {
            return redirect()->route('companies.index');
        }

        $company->name = $request->company_name;
        $company->email = $request->company_email;

        if ($request->hasFile('company_image')) {
            $imagePath = $request->file('company_image')->store('public/companies');
            $company->logo = Storage::url($imagePath);
        }

        $company->save();

        return redirect()->route('companies.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);

        if (!$company) {
            return redirect()->route('companies.index');
        }

        $employees = $company->employee;

        if ($employees) {
            foreach ($employees as $employee) {
                $employee->delete();
            }
        }

        $company->delete();

        return redirect()->route('companies.index');
    }


}
