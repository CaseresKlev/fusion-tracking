<?php

namespace App\Http\Controllers;


use App\DataTables\SettingDataTable;
use App\Models\Setting;
use App\Http\Requests\SettingsFormRequest;
use Yajra\DataTables\Facades\DataTables;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(SettingDataTable $dataTable)
    {
        return view("settings.index");
    }

    public function ajaxGetData(){
        $data = Setting::query();
        return DataTables::of(Setting::query())
        ->addIndexColumn()
        ->addColumn('action', function($dataRow){
            $row = '<div class="row">
            <div class="col icons-option class="text-right"" >
            <a href="' . route("settings.show", $dataRow->id) . '"><i class="fa-solid fa-eye"></i></a>
            <a href="' . route("settings.edit",$dataRow->id) . '"><i class="fas fa-edit"></i></a>';
            if(strcmp( (string) $dataRow->added_by , (string) 'SYSTEM') !== 0 ){
                $row .= '<a href="#" onclick="deleteRecord('. $dataRow->id .', \''. $dataRow->name .'\')"><i class="fa-solid fa-trash-can"></i></a>';
            }
            
            $row .= '</div>
            </div>
            
            <form action="' . route("settings.destroy", $dataRow->id) . '" method="POST" class="hidden" id="form-delete-'. $dataRow->id .'" 
            >
   <input name="_method" type="hidden" value="DELETE">
   '. csrf_field() .'
</form>
            
            ';
            return $row;
        })
        ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.create_update', 
        [
            'actionMethod' => "create", 
            'actionDescription' => "Create Record" ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SettingsFormRequest $request)
    {
        //
        $data = $request->validated();
        $setting = new Setting();
        $setting->app_name = $data['app_name'];
        $setting->app_section = $data['app_section'];
        $setting->app_field = $data['app_field'];
        $setting->app_value_1 = $data['app_value_1'];
        $setting->app_value_2 = $data['app_value_2'];
        $setting->app_value_3 = $data['app_value_3'];
        $setting->added_by = 'USER';
        $setting->app_setting_description = $data['app_setting_description'];

        $setting->save();
        return redirect()->route('dashboard.settings')
        ->with([ 
         'confirmationMessage' => $setting->app_name . " | " . $setting->app_section . " | " . $setting->app_field . " | " . " was created succesfully.",
         'alertType' =>'success' 
         ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        return view("settings.create_update", 
        [
            'actionMethod' => "view", 
            'actionDescription' => "View Record", 
            'record' => $setting ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        return view("settings.create_update", 
        [
            'actionMethod' => "edit", 
            'actionDescription' => "Edit Record", 
            'record' => $setting ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SettingsFormRequest $request, Setting $setting)
    {
        $data = $request->validated();
        $setting->app_value_1 = $data['app_value_1'];
        $setting->app_value_2 = $data['app_value_2'];
        $setting->app_value_3 = $data['app_value_3'];
        $setting->app_setting_description = $data['app_setting_description'];

        $setting->save();
        return redirect()->route('dashboard.settings')
        ->with([ 
         'confirmationMessage' => $setting->app_name . " | " . $setting->app_section . " | " . $setting->app_field . " | " . " was updated succesfully.",
         'alertType' =>'success' 
         ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();
        return redirect()->route('dashboard.settings')
       ->with([ 
        'confirmationMessage' => $setting->name  . " setting was deleted succesfully.",
        'alertType' =>'success' 
        ]);
    }
}
