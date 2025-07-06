<?php

namespace App\Http\Controllers;
use App\Models\Services;
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
        return view('pages.client-appointment-view');
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
                'servicename' => 'required|string|max:255|unique:services,Service_Name',
                'serviceprice' => 'required|numeric|min:0',
                'servicedescription' => 'required|string|max:1000|unique:services,Service_Description',
                'serviceimage' => 'required|image|mimes:jpeg,png,jpg,svg'
            ]);
            try {
                DB::beginTransaction();
                $newService = new Services();
                $newService->Service_Name = $request->input('servicename');
                $newService->Service_Price = $request->input('serviceprice');
                $newService->Service_Description = $request->input('servicedescription');
                if ($request->hasFile('serviceimage')) {
                    $image = $request->file('serviceimage');
                    $imagePath = $image->store('service_images', 'public');
                    $newService->Service_Image_Path = $imagePath;
                } else {
                    return response()->json(['message' => 'Service image is required'], 400);
                }
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
}
