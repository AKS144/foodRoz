<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AddOn;
use App\Models\Restaurant;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Rap2hpoutre\FastExcel\FastExcel;
use Illuminate\Support\Facades\DB;
use App\Scopes\RestaurantScope; 

class AddOnController extends Controller
{
    public $Module              = 'AddOn';
    public $RecordModule        = 'AddOn';
    public $RecordAddModule     = 'Add New AddOn';
    public $RecordEditModule    = 'Edit AddOn';
    public $RecordShowModule    = 'View AddOn';
    public $ViewFolder          =  'admin-views.addon';
    public $RoutePrefixName     = 'admin.addon';

    public function index(Request $request)
    {
        $restaurant_id = $request->query('restaurant_id', 'all');
        $addons = AddOn::withoutGlobalScope(RestaurantScope::class)
        ->when(is_numeric($restaurant_id), function($query)use($restaurant_id){
            return $query->where('restaurant_id', $restaurant_id);
        })
        ->orderBy('name')->paginate(config('default_pagination'));
        $restaurant =$restaurant_id !='all'? Restaurant::findOrFail($restaurant_id):null;
        return view('admin-views.addon.index', compact('addons', 'restaurant'));
    }

    public function list(Request $request)
    {
        $restaurant_id = $request->query('restaurant_id', 'all');
        $addons = AddOn::withoutGlobalScope(RestaurantScope::class)
        ->when(is_numeric($restaurant_id), function($query)use($restaurant_id){
            return $query->where('restaurant_id', $restaurant_id);
        })
        ->orderBy('name')->paginate(config('default_pagination'));
        $restaurant =$restaurant_id !='all'? Restaurant::findOrFail($restaurant_id):null;

        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordAddModule    = $this->RecordAddModule;
        $RoutePrefixName    = $this->RoutePrefixName;

        return view('admin-views.addon.list', compact('addons', 'restaurant','RecordModule','RecordAddModule','RoutePrefixName'));
    }

    public function create(Request $request) 
    {
        $restaurant_id      = $request->query('restaurant_id', 'all');     

        $restaurant         = Restaurant::orderBy('id','DESC')->get();  
        
        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordAddModule    = $this->RecordAddModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('Module','RecordModule','RecordAddModule','RoutePrefixName','restaurant'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'restaurant_id' => 'required',
            'price' => 'required',
        ], [
            'name.required' => 'Name is required!',
            'restaurant_id.required' => trans('messages.please_select_restaurant'),
        ]);

        $addon = new AddOn();
        $addon->name = $request->name;
        $addon->price = $request->price;
        $addon->restaurant_id = $request->restaurant_id;
        $addon->display_price = $request->display_price;
        $addon->description = $request->description;
        $addon->discount = $request->discount;
        $addon->discount_type = $request->discount_type;
        $addon->save();
        Toastr::success(trans('messages.addon_added_successfully'));
        return redirect()->route($RoutePrefixName.'.list');
        return back();
    }

    public function edit(Request $request,$id)
    {
        $restaurant_id      = $request->query('restaurant_id', 'all');     

        $restaurant         = Restaurant::orderBy('id','DESC')->get();  
        
        $Record = AddOn::withoutGlobalScope(RestaurantScope::class)->find($id);

        $Module             = $this->Module;
        $RecordModule       = $this->RecordModule;
        $RecordEditModule   = $this->RecordEditModule;
        $RoutePrefixName    = $this->RoutePrefixName;
        return view($this->ViewFolder.'.add-edit', compact('Record','Module','RecordModule','RecordEditModule','RoutePrefixName','restaurant'));

        /*$addon = AddOn::withoutGlobalScope(RestaurantScope::class)->find($id);
        return view('admin-views.addon.edit', compact('addon'));*/
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'restaurant_id' => 'required',
            'price' => 'required',
        ], [
            'name.required' => 'Name is required!',
            'restaurant_id.required' => trans('messages.please_select_restaurant'),
        ]);

        $addon = AddOn::withoutGlobalScope(RestaurantScope::class)->find($id);
        $addon->name = $request->name;
        $addon->price = $request->price;
        $addon->restaurant_id = $request->restaurant_id;
        $addon->display_price = $request->display_price;
        $addon->description = $request->description;
        $addon->discount = $request->discount;
        $addon->discount_type = $request->discount_type;
        $addon->save();

        $RoutePrefixName    = $this->RoutePrefixName;

        Toastr::success(trans('messages.addon_updated_successfully'));
        return redirect()->route($RoutePrefixName.'.list');
        return redirect(route('admin.addon.add-new'));
    }

    public function delete(Request $request)
    {
        $addon = AddOn::withoutGlobalScope(RestaurantScope::class)->find($request->id);
        $addon->delete();
        Toastr::success(trans('messages.addon_deleted_successfully'));
        return back();
    }

    public function status($addon, Request $request)
    {
        $addon_data = AddOn::withoutGlobalScope(RestaurantScope::class)->find($addon);
        $addon_data->status = $request->status;
        $addon_data->save();
        Toastr::success(trans('messages.addon_status_updated'));
        return back();
    }

    public function search(Request $request){
        $key = explode(' ', $request['search']);
        $addons=AddOn::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%");
            }
        })->limit(50)->get();
        return response()->json([
            'view'=>view('admin-views.addon.partials._table',compact('addons'))->render()
        ]);
    }
    public function bulk_import_index()
    {
        return view('admin-views.addon.bulk-import');
    }

    public function bulk_import_data(Request $request)
    {
        try {
            $collections = (new FastExcel)->import($request->file('products_file'));
        } catch (\Exception $exception) {
            Toastr::error(trans('messages.you_have_uploaded_a_wrong_format_file'));
            return back();
        }

        $data = [];
        foreach ($collections as $collection) {
                if ($collection['name'] === "" && $collection['restaurant_id'] === "") {
                    Toastr::error(trans('messages.please_fill_all_required_fields'));
                    return back();
                }


            array_push($data, [
                'name' => $collection['name'],
                'restaurant_id' => $collection['restaurant_id'],
                'created_at'=>now(),
                'updated_at'=>now()
            ]);
        }
        DB::table('add_ons')->insert($data);
        Toastr::success(trans('messages.addon_imported_successfully', ['count'=>count($data)]));
        return back();
    }

    public function bulk_export_index()
    {
        return view('admin-views.addon.bulk-export');
    }

    public function bulk_export_data(Request $request)
    {
        $request->validate([
            'type'=>'required',
            'start_id'=>'required_if:type,id_wise',
            'end_id'=>'required_if:type,id_wise',
            'from_date'=>'required_if:type,date_wise',
            'to_date'=>'required_if:type,date_wise'
        ]);
        $addons = AddOn::when($request['type']=='date_wise', function($query)use($request){
            $query->whereBetween('created_at', [$request['from_date'].' 00:00:00', $request['to_date'].' 23:59:59']);
        })
        ->when($request['type']=='id_wise', function($query)use($request){
            $query->whereBetween('id', [$request['start_id'], $request['end_id']]);
        })
        ->withoutGlobalScope(RestaurantScope::class)->get();
        return (new FastExcel($addons))->download('Addons.xlsx');
    }
}
