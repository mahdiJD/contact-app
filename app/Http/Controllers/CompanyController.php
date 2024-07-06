<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    public function __construct(
                protected $perPage = 5,
            ){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $companies = Company::
            allowedTrash()
            ->allowedSorts(['name','website','email'] , '-id')
            ->allowedSearch('name','website','email')
            ->forUser(auth()->user())
            ->paginate($this->perPage);
        return view('companies.index', ['companies' => $companies ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $company = new Company();
        return view('companies.create')->with('company',$company);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        $company = auth()->user()->companies()->create($request->validated());
        return redirect()->route('companies.index')->with('message','Company has been created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company)
    {
        return view('companies.show')->with('company',$company);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
        return view('companies.edit')->with('company' , $company);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->validated());
        return redirect()->route('companies.index')->with('message','Company info has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company)
    {
        $company->contact()->delete();
        $company->delete();
        $redirect = request()->query('redirect');
        return ($redirect ? redirect()->route($redirect):back())
            ->with('message','Company has been move to the Trash successfully')
            ->with('undoRoute',$this->getUndoRoute('companies.restore', $company));
    }
    public function restore(Company $company){
        $company->restore();
        $company->contact()->restore();
        $redirect = request()->query('redirect');
        return ($redirect ? redirect()->route($redirect):back())
            ->with('message','Company has been move to the Trash successfully restored from trash')
            ->with('undoRoute',$this->getUndoRoute('companies.destroy', $company));
    }
    public function forceDelete(Company $company){
        $company->contact()->forceDelete();
        $company->forceDelete();
        return back()
            ->with('message','Contact has been remove from DB successfully.');
    }
    protected function getUndoRoute($name , $resource){
        return request()->missing('undo') ? route($name , [$resource->id , 'undo' => true]):null;
    }
}
