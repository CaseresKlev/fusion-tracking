<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Services\DataTable;
use App\DataTables\CompanyDataTable;
use App\Models\Company;
use Illuminate\Support\Facades\View;
use App\Http\Requests\CompanyFormRequest;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CompanyDataTable $dataTable)
    {
        
        return $dataTable->render("company.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("company.create_update", 
        [
            'actionMethod' => "create", 
            'actionDescription' => "Create new record", 
            'alertType' =>'success', 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CompanyFormRequest $request)
    {
        $data = $request->validated();

        $company = new Company();
        $company->name = $data['name'];
        $company->address = $data['address'];
        $company->contact_no = $data['contact_no'];
        $company->email = $data['email'];
        $company->description = $data['description'];

        $company->save();
        
        return redirect()->route('dashboard.company')
       ->with([ 
        'confirmationMessage' => $company->name . " was created succesfully.",
        'alertType' =>'success' 
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view("company.create_update", 
        [
            'actionMethod' => "view", 
            'actionDescription' => "View Record", 
            'alertType' =>'success', 
            'record' => $company 
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {
    
        return view("company.create_update", 
        [
            'actionMethod' => "edit", 
            'actionDescription' => "Edit Record", 
            'record' => $company ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CompanyFormRequest $request, Company $company)
    {
        //PUT

        $data = $request->validated();

        $company->name = $data['name'];
        $company->address = $data['address'];
        $company->contact_no = $data['contact_no'];
        $company->email = $data['email'];
        $company->description = $data['description'];

        $company->save();
        
        return view("company.create_update", 
        [   'confirmationMessage' => $company->name . " was updated succesfully.",
            'alertType' =>'success',
            'actionMethod' => "edit", 
            'actionDescription' => "Edit Record", 
            'record' => $company ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();
        // return view(route('dashboard.company'), [ 
        //     'confirmationMessage' => $company->name . " was deleted succesfully.",
        //     'alertType' =>'success' 
        // ]);
        return redirect()->route('dashboard.company')
       ->with([ 
        'confirmationMessage' => $company->name . " was deleted succesfully.",
        'alertType' =>'success' 
        ]);
    }
}
