<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    // List all companies of logged-in user
    public function index()
    {
        return response()->json(Auth::user()->companies);
    }

    // Create a company
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'industry' => 'nullable|string',
        ]);

        $company = Auth::user()->companies()->create($request->all());

        return response()->json([
            'status' => true,
            'message' => 'Company created successfully',
            'company' => $company
        ]);
    }

    // Update a company
  

    public function update(Request $request, $id)
{
    $company = Company::find($id);

    if (!$company) {
        return response()->json([
            'status' => false,
            'message' => 'Company not found'
        ], 404);
    }

    // Check if company belongs to logged-in user
    if ($company->user_id !== Auth::id()) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized: You do not own this company'
        ], 403);
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'address' => 'nullable|string',
        'industry' => 'nullable|string',
    ]);

    $company->update($request->all());

    return response()->json([
        'status' => true,
        'message' => 'Company updated successfully',
        'company' => $company
    ]);
}


    // Delete a company
  
 public function destroy($id)
{
    $company = Company::findOrFail($id);
    
    // Explicit authorization check
    if ($company->user_id !== Auth::id()) {
        return response()->json([
            'status' => false,
            'message' => 'Unauthorized: You do not own this company'
        ], 403);
    }

    $company->delete();

    return response()->json([
        'status' => true,
        'message' => 'Company deleted successfully'
    ], 200);
}











}
