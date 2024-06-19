<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\DishModel,App\Models\Category;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon; 

class DishController extends Controller
{
    public $Module              = 'Dishes';
    public $RecordModule        = 'Dishes';
    public $RecordAddModule     = 'Add Dishes';
    public $RecordEditModule    = 'Edit Dish';
    public $RecordShowModule    = 'View Dish';
    public $RoutePrefixName     = 'admin.food-dish';
    public $ViewFolder          =  'admin-views.dishes';
        
    public function index(Request $Request) 
    {
        $Records            = DishModel::orderBy('id','DESC')->get();
        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordAddModule    = $this->RecordAddModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view('admin-views.dishes.index',compact('Records','Module','RecordModule','RecordAddModule','RoutePrefixName'));

    }

    public function create() 
    {
        $categories         = Category::where('status',1)->where('parent_id', 0)->orderBy('id','DESC')->get();    
        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordAddModule    = $this->RecordAddModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('categories','Module','RecordModule','RecordAddModule','RoutePrefixName'));
    }

    public function store(Request $request) 
    {
        //dd($request->all());    

        DB::beginTransaction();
            try {
                $Records                            = new DishModel;
                $Records->name                      = $request->name;
                $Records->description               = $request->description;
                $Records->display_price             = $request->display_price;
                $Records->maximum_seller_price      = $request->maximum_seller_price;
                $Records->discount                  = $request->discount;
                $Records->discount_type             = $request->discount_type;
                $Records->item_type                 = $request->item_type;
                $Records->category_id               = $request->category_id;
                $Records->dish_attributes           = $request->dish_attributes;
                $Records->addons                    = $request->addons;
                $Records->available_time_starts     = $request->available_time_starts;
                $Records->available_time_ends       = $request->available_time_ends;
                $Records->preparation_time          = $request->preparation_time;
                $Records->metadata                  = $request->metadata;

                if($request->hasFile('image'))
                {
                    $image       = $request->file("image");
                    $filename    = time(). '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('admin/dishes/'), $filename);
                    $Records->image         = $filename;
                }

                $Records->save();
                DB::commit();
                $request->session()->flash('message', 'Dish Created Successfully.');
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
        $categories           = Category::where('status',1)->where('parent_id', 0)->orderBy('id','DESC')->get(); 
        $Record               = DishModel::findOrFail($id);
        $Module               = $this->Module;
        $RecordModule         = $this->RecordModule;
        $RecordEditModule     = $this->RecordEditModule;
        $RoutePrefixName      = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('categories','Record','Module','RecordModule','RecordEditModule','RoutePrefixName'));
    }

    public function update(Request $request, $id) 
    {

        try {
                $Records                            = DishModel::findOrFail($id);
                $Records->name                      = $request->name;
                $Records->description               = $request->description;
                $Records->display_price             = $request->display_price;
                $Records->maximum_seller_price      = $request->maximum_seller_price;
                $Records->discount                  = $request->discount;
                $Records->discount_type             = $request->discount_type;
                $Records->item_type                 = $request->item_type;
                $Records->category_id               = $request->category_id;
                $Records->dish_attributes           = $request->dish_attributes;
                $Records->addons                    = $request->addons;
                $Records->available_time_starts     = $request->available_time_starts;
                $Records->available_time_ends       = $request->available_time_ends;
                $Records->preparation_time          = $request->preparation_time;
                $Records->metadata                  = $request->metadata;

                if($request->hasFile('image'))
                {
                    $image       = $request->file("image");
                    $filename    = time(). '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                    $image->move(public_path('admin/dishes/'), $filename);
                    $Records->image         = $filename;
                }

                $Records->save();
                DB::commit();
                
                $request->session()->flash('message', 'Dish Updated Successfully.');

            } 
            catch (\Exception $e) {
                DB::rollback();
                $request->session()->flash('message',$e->getMessage());
            }
        return redirect()->route($this->RoutePrefixName.'.index');
    }
        

    public function destroy(Request $request, $id)
    {
        $user = DishModel::destroy($id);
        $request->session()->flash('message', 'Dish deleted successfully.');
        return redirect()->route($this->RoutePrefixName.'.index');
    }


}
