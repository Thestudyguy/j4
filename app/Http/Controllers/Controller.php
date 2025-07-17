<?php

namespace App\Http\Controllers;
use App\Models\Doctors;
use App\Models\Services;
use App\Models\sub_services;
use App\Models\User;
use Illuminate\Http\Request;
use Log;
use Illuminate\Support\Facades\DB;
use Validator;
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
    
Log::info($request->all());

    $validated = $request->validate([
        'servicename' => 'required|string|max:255|unique:sub_services,Service',
        'serviceprice' => 'required|numeric',
        'servicedescription' => 'required|string|max:1000',
        'parent-service-id' => 'nullable|exists:services,id',
        'serviceimage' => 'required|image|mimes:jpg,jpeg,png',
    ]);
    try {
        $image = $request->file('serviceimage');
        $fileName = 'sub_service_' . time() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('services', $fileName, 'public');

        $subService = sub_services::create([
            'parent_service' => $validated['parent-service-id'],
            'Service' => $validated['servicename'],
            'Price' => $validated['serviceprice'],
            'Description' => $validated['servicedescription'],
            'image_path' => $imagePath,
        ]);
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

    public function GetSubServices($id){
        try {
            $trimmedId = explode('_', $id);
            Log::info($trimmedId[2]);
            $subServices = sub_services::where('parent_service', $trimmedId[2])->get();
            return response()->json(['sub_services' => $subServices], 200);
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function DoctorsPage(){
        try {
            $doctors = Doctors::all();
            return view('pages.dashboard-doctors', compact('doctors'));
        } catch (\Exception $th) {
            throw $th;
        }
    }

    public function NewDoctors(Request $request)
{
    try {
        // Log::info($request->all());
        // return;
       $validator = Validator::make($request->all(), [
    'ProfessionalTitle' => 'nullable|string|max:40',
    'FirstName' => 'required|string|max:100',
    'LastName' => 'required|string|max:100',
    'MiddleName' => 'nullable|string|max:100',
    'Suffix' => 'nullable|string|max:10',
    'MDLink' => 'required',
    'AreaOfExpertise' => 'nullable|string|max:255',
    'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ])->after(function ($validator) use ($request) {
            $exists = Doctors::where('FirstName', $request->FirstName)
                ->where('LastName', $request->LastName)
                ->where(function($query) use ($request) {
                    $requestMiddle = $request->MiddleName ?? '';
                    $query->where('MiddleName', $requestMiddle)
                        ->orWhere(function($q) use ($requestMiddle) {
                            $q->whereNull('MiddleName')->whereRaw('? = ""', [$requestMiddle]);
                        });
                })
                ->exists();

            if ($exists) {
                $validator->errors()->add('FirstName', 'A doctor with the same full name already exists.');
            }
        });

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $doctor = new Doctors($request->except('image_path'));

        if ($request->hasFile('image_path')) {
            $file = $request->file('image_path');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('doctors', $filename, 'public');
            $doctor->image_path = 'storage/' . $path;
        }

        $doctor->isVisible = $request->has('isVisible');
        $doctor->save();

        return response()->json(['message' => 'Doctor created successfully.']);
    } catch (\Throwable $th) {
        return response()->json(['error' => 'Server error occurred.'], 500);
    }
}
}
