<?php

namespace App\Http\Controllers;
use App\Models\Services;
use App\Models\sub_services;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
class Controller
{
    //

    public function Dashboard(){
        return view('pages.dashboard-dashboard');
    }

    public function ClientDashboard(){
        return view('pages.dashboard-dashboard');
    }

    public function DentistDashboard(){
        return view('pages.dentist-dashboard');
    }

    public function ServicesDashboard(){
        $services = Services::where('isVisible', 1)->get();


        return view('pages.dashboard-services', compact('services'));
    }

    public function NewService(Request $request)
    {

            $validateEntry = $request->validate([
                'servicename' => 'required|string|max:255|unique:services,Service',
            ]);
            try {
                DB::beginTransaction();
                $newService = new Services();
                $newService->Service = $request->input('servicename');
                $newService->save();
                DB::commit();
                return response()->json(['message'=>'New Service Created']);
            } catch (\Exception $ex) {
                DB::rollBack();
                return response()->json(['message' => 'Validation failed', 'error' => $ex->getMessage()], 422);
            }
    }


    public function RemoveService($id){
    try {
        DB::beginTransaction();
        Services::where('id', $id)->update(['isVisible' => false]);
        DB::commit();
        return response()->json(['message' => 'Service removed', 'id' => $id]);
    } catch (\Exception $ex) {
        DB::rollBack();
        return response()->json(['error' => 'Failed to remove service', 'details' => $ex->getMessage()], 500);
    }
}

    public function NewSubService(Request $request)
{
    // ✅ Step 1: Validate input
    $validated = $request->validate([
        'servicename' => 'required|string|max:255|unique:sub_services,Service',
        'serviceprice' => 'required|numeric',
        'servicedescription' => 'required|string|max:1000',
        'parent-service-id' => 'nullable|exists:services,id',
        'serviceimage' => 'required|image|mimes:jpg,jpeg,png',
    ]);

    try {
        // ✅ Step 2: Store the image in storage/app/public/services
        $imagePath = $request->file('serviceimage')->store('services', 'public');

        // ✅ Step 3: Create new sub-service record
        $subService = sub_services::create([
            'parent_service' => $validated['parent-service-id'],
            'Service' => $validated['servicename'],
            'Price' => $validated['serviceprice'],
            'Description' => $validated['servicedescription'],
            // Optional: store image path if you have a column for it later
        ]);

        // ✅ Optional: Log for debugging
        Log::info('Sub-service added successfully.', ['id' => $subService->id]);

        return response()->json([
            'success' => true,
            'message' => 'Sub-service created successfully.',
            'data' => $subService,
        ], 201);

    } catch (\Exception $e) {
        Log::error('Error creating sub-service: ' . $e->getMessage());

        return response()->json([
            'success' => false,
            'message' => 'Something went wrong while creating sub-service.',
        ], 500);
    }
}
}
