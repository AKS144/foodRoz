<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OfferBanners,App\Models\DishModel;
use DB;

class OfferBannerController extends Controller
{
    public $Module              = 'Offer Banners';
    public $RecordModule        = 'Offer Banners';
    public $RecordAddModule     = 'Add New Offer Banner';
    public $RecordEditModule    = 'Edit Offer Banner';
    public $RecordShowModule    = 'View Offer Banners';
    public $ViewFolder          =  'admin-views.offer_banners';
    public $RoutePrefixName     = 'admin.offer_banners';

 
    public function index(Request $Request) 
    {
        
        $Records            = OfferBanners::orderBy('id','DESC')->get();
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
                    $Records                            = new OfferBanners;
                    $Records->title                     = $request->title;
                    $Records->type                      = $request->type;
                    $Records->status                    = $request->status;

                    if($request->hasFile('image'))
                    {
                        $image       = $request->file("image");
                        $filename    = time(). '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/offer_banners/'), $filename);
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
        $Record             = OfferBanners::findOrFail($id);
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
                    $Records                            = OfferBanners::findOrFail($id);
                     $Records->title                     = $request->title;
                    $Records->type                      = $request->type;
                    $Records->status                    = $request->status;

                    if($request->hasFile('image'))
                    {
                        $image       = $request->file("image");
                        $filename    = time(). '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/offer_banners/'), $filename);
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
        $user = OfferBanners::destroy($id);
        $request->session()->flash('message', 'Record deleted successfully.');
        return redirect()->route($this->RoutePrefixName.'.index');
    }

    public function update_status (Request $request)
    {
        $banner = OfferBanners::find($request->id);
        $banner->status = $request->status;
        $banner->save();
        $request->session()->flash('message', 'Status updated successfully.');
        return back();
    }

}
