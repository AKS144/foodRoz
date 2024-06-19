<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PassModel,App\Models\DishModel;
use DB;

class PassController extends Controller
{
    public $Module              = 'Pass';
    public $RecordModule        = 'Pass';
    public $RecordAddModule     = 'Add New Pass';
    public $RecordEditModule    = 'Edit Pass';
    public $RecordShowModule    = 'View Pass';
    public $ViewFolder          =  'admin-views.passes';
    public $RoutePrefixName     = 'admin.passes';


    public function index(Request $Request) 
    {
        
        $Records            = PassModel::orderBy('id','DESC')->get();
        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordAddModule    = $this->RecordAddModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        $ModuleViewFolder   = $this->ViewFolder;
        return view($this->ViewFolder.'.index', compact('Records','Module','RecordModule','RecordAddModule','RoutePrefixName','Request','ModuleViewFolder'));
    }

    public function create() 
    {       
        $Module             = $this->Module;
        $Dishes             = DishModel::orderBy('id','DESC')->get();
        $RecordModule       = $this->RecordModule;
        $RecordAddModule    = $this->RecordAddModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('Module','RecordModule','RecordAddModule','RoutePrefixName','Dishes'));
    }

    public function store(Request $request) 
    {
        //dd($request->all());

        DB::beginTransaction();
            try {
                    $Records                            = new PassModel;
                    $Records->title                     = $request->title;
                    $Records->pass_name                 = $request->pass_name;
                    $Records->number_of_orders          = $request->number_of_orders;
                    $Records->validity                  = $request->validity;
                    $Records->limit_for_same_user       = $request->limit_for_same_user;
                    $Records->start_date                = $request->start_date;
                    $Records->expire_date               = $request->expire_date;

                    $implode                            = implode(',', $request->dishes);

                    $Records->dishes                    = $implode;

                    if($request->hasFile('image'))
                    {
                        $image       = $request->file("image");
                        $filename    = time(). '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/passes/'), $filename);
                        $Records->image         = $filename;
                    }
                    
                    $Records->save();
                    DB::commit();
                    $request->session()->flash('message', 'Record Added Successfully.');
                } 
            catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('message',$e->getMessage());
            }
        return redirect()->route($this->RoutePrefixName.'.index');
    }

    public function edit($id) 
    {
        $Record             = PassModel::findOrFail($id);
        $Dishes             = DishModel::orderBy('id','DESC')->get();
        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordEditModule   = $this->RecordEditModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('Record','Module','RecordModule','RecordEditModule','RoutePrefixName','Dishes'));
    }

    public function show()
    {
        
    }
    public function update(Request $request,$id) 
    {
        DB::beginTransaction();
            try {
                    $Records                            = PassModel::findOrFail($id);
                    $Records->title                     = $request->title;
                    $Records->pass_name                 = $request->pass_name;
                    $Records->number_of_orders          = $request->number_of_orders;
                    $Records->validity                  = $request->validity;
                    $Records->limit_for_same_user       = $request->limit_for_same_user;
                    $Records->start_date                = $request->start_date;
                    $Records->expire_date               = $request->expire_date;

                    $implode                            = implode(',', $request->dishes);

                    $Records->dishes                    = $implode;
                    
                    if($request->hasFile('image'))
                    {
                        $image       = $request->file("image");
                        $filename    = time(). '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/passes/'), $filename);
                        $Records->image         = $filename;
                    }
                    
                    $Records->save();
                    DB::commit();
                    $request->session()->flash('message', 'Record Updated Successfully.');
            } 
            catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('message',$e->getMessage());
            }
        return redirect()->route($this->RoutePrefixName.'.index');
    }


    public function destroy(Request $request, $id)
    {
        $user = PassModel::destroy($id);
        $request->session()->flash('message', 'Record deleted successfully.');
        return redirect()->route($this->RoutePrefixName.'.index');
    }

}
