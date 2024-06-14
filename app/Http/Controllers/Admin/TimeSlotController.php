<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TimesSlots;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class TimeSlotController extends Controller
{
    public $Module              = 'Times Slots';
    public $RecordModule        = 'Times Slots';
    public $RecordAddModule     = 'Add Times Slots';
    public $RecordEditModule    = 'Edit Times Slot';
    public $RecordShowModule    = 'View Times Slot';
    public $RoutePrefixName     = 'admin.time-slot';
    public $ViewFolder          =  'admin-views.timeslots';
        
    public function index(Request $Request) 
    {
        $Records            = TimesSlots::orderBy('id','DESC')->get();
        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordAddModule    = $this->RecordAddModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view('admin-views.timeslots.index',compact('Records','Module','RecordModule','RecordAddModule','RoutePrefixName'));

    }

    public function create() {
        
        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordAddModule    = $this->RecordAddModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('Module','RecordModule','RecordAddModule','RoutePrefixName'));
    }

    public function store(Request $request) 
    {
        //dd($request->all());    

        DB::beginTransaction();
            try {
                $Records                        = new TimesSlots;
                $Records->time_from             = $request->time_from;
                $Records->time_to               = $request->time_to;
                $Records->happy_hour_tag        = $request->happy_hour_tag;
                $Records->happy_hour_discount   = $request->happy_hour_discount;

                if($request->hasFile('happy_hour_image'))
                {
                    $image       = $request->file("happy_hour_image");
                    $filename    = time(). '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('admin/timeslots/'), $filename);
                    $Records->happy_hour_image         = $filename;
                }

                $Records->save();
                DB::commit();
                $request->session()->flash('message', 'Times Slot Created Successfully.');
            } 
            catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('message',$e->getMessage());
            }
        return redirect()->route($this->RoutePrefixName.'.index');
    }

    
    public function show($id) 
    {
        
    }

   
    public function edit($id) 
    {
        
        $Record               = TimesSlots::findOrFail($id);
        $Module               = $this->Module;
        $RecordModule         = $this->RecordModule;
        $RecordEditModule     = $this->RecordEditModule;
        $RoutePrefixName      = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('Record','Module','RecordModule','RecordEditModule','RoutePrefixName'));
    }

    public function update(Request $request, $id) 
    {

        try {
                $Records = TimesSlots::findOrFail($id);
                $Records->time_from             = $request->time_from;
                $Records->time_to               = $request->time_to;
                $Records->happy_hour_tag        = $request->happy_hour_tag;
                $Records->happy_hour_discount   = $request->happy_hour_discount;

                if($request->hasFile('happy_hour_image'))
                {
                    $image       = $request->file("happy_hour_image");
                    $filename    = time(). '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('admin/timeslots/'), $filename);
                    $Records->happy_hour_image         = $filename;
                }

                $Records->save();
                DB::commit();
                $request->session()->flash('message', 'Times Slot Updated Successfully.');

            } 
            catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('message',$e->getMessage());
            }
        return redirect()->route($this->RoutePrefixName.'.index');
    }
        

    public function destroy(Request $request, $id)
    {
        $user = TimesSlots::destroy($id);
        $request->session()->flash('message', 'Times Slot deleted successfully.');
        return redirect()->route($this->RoutePrefixName.'.index');
    }


}
