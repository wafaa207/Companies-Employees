<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function getAllCompanies()
    {
        $companies = Company::get();

        return response()->json(['companies' => $companies]);
    }

    public function getCompany($id)
    {
        $company = Company::with('employee')->find($id);

        if (!$company) {
            return response()->json(['error' => 'Company not found'], 404);
        }

        return response()->json(['company' => $company]);
    }
}

