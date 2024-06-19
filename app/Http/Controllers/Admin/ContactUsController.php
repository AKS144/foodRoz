<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactUs;
use DB, Session;

class ContactUsController extends Controller
{
    public $Module              = 'Contact Us';
    public $RecordModule        = 'Contact Us';
    public $RecordAddModule     = 'Add New Contact Us';
    public $RecordEditModule    = 'Edit Contact Us';
    public $RecordShowModule    = 'View Contact Us';
    public $ViewFolder          =  'admin-views.contact_us';
    public $RoutePrefixName     = 'admin.contact_us';


    public function index(Request $Request)     
    {
        
        $Records            = ContactUs::orderBy('id','DESC')->get();
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
                    $Records                            = new ContactUs;
                    $Records->name                      = $request->name;                    
                    $Records->phone                     = $request->phone;
                    $Records->email                     = $request->email;
                    $Records->message                   = $request->message;  
                    
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
        $Record             = ContactUs::findOrFail($id);
        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordEditModule   = $this->RecordEditModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('Record','Module','RecordModule','RecordEditModule','RoutePrefixName'));
    }

    public function show()
    {
        
    }
    public function update(Request $request,$id) 
    {
        DB::beginTransaction();
            try {
                    $Records                            = ContactUs::findOrFail($id);
                    $Records->name                      = $request->name;                    
                    $Records->phone                     = $request->phone;
                    $Records->email                     = $request->email;
                    $Records->message                   = $request->message;  
                    
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
        $user = ContactUs::destroy($id);
        $request->session()->flash('message', 'Record deleted successfully.');
        return redirect()->route($this->RoutePrefixName.'.index');
    }

}
