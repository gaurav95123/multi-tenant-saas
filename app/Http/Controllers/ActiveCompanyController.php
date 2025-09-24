<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserActiveCompany;

class ActiveCompanyController extends Controller
{
    public function setActive(Request $request)
    {
        $request->validate([
            'company_id' => 'required|exists:companies,id'
        ]);

        $user = auth()->user();

        // Check ownership
        $company = $user->companies()->find($request->company_id);
        if (!$company) {
            return response()->json(['message' => 'Company not found or unauthorized'], 404);
        }

        // Create or update active company
        UserActiveCompany::updateOrCreate(
            ['user_id' => $user->id],
            ['company_id' => $company->id]
        );

        return response()->json([
            'message' => 'Active company set successfully',
            'active_company' => $company
        ]);
    }

    public function getActive()
    {
        $active = auth()->user()->activeCompanyRelation; // relationship
        if (!$active) {
            return response()->json(['message' => 'No active company set'], 404);
        }

        return response()->json($active->company);
    }
    
}
