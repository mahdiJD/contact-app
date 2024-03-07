<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;


class ContactController extends Controller
{

    public function __construct(
        protected CompanyRepository $companies,
        protected $perPage = 10,
    ){

    }
//    protected function getContact(){
//        return [
//            1 => ['name' => 'mahdi', 'phone' => '0912345678'],
//            2 => ['name' => 'hasan', 'phone' => '0917584934'],
//            3 => ['name' => 'reza', 'phone' => '09185730932']
//        ];
//    }

    public function index() {
//        $contacts = $this->getContact();
        $companies = $this->companies->pluck();
        $this->perPage = request()->query('perPage');
        $contacts = Contact::latest()
            ->where(function ($query) {
                if ($companyId = request()->query('company_id')) {
                    $query->where('company_id', $companyId);
                }
            })->paginate($this->perPage);

//        $contactsCollection = Contact::latest()->get();
//        $perPage = 10;
//        $currentPage  = \request()->query('page',1);
//        $items = $contactsCollection->slice( ($currentPage * $perPage) - $perPage , $perPage);
//        $total = $contactsCollection->count();
//
//        $contacts = new LengthAwarePaginator($items,$total,$perPage,$currentPage,
//            [
//                'path' => request()->url(),
//                'query' => \request()->query(),
//            ]
//        );
        return view('contacts.index', ['contacts' => $contacts ,'companies'=>$companies]);// ->with('com');
    }

    public function store(Request $request){
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id',
        ]);

        Contact::created($request->all());

        return redirect()->route('contact.index')->with('message','Contact has been created successfully');
    }

    public function show ($id = null) {
//    if (not($id)) return view('contact.show');
//        $contacts = $this->getContact();
        $contact = Contact::findOrFail($id);
//        abort_if(empty($contact) , 404);
        return view('contacts.show',['contact' => $contact]);
    }

    public  function create () {
        $companies =$this->companies->pluck();
        $contact = new Contact();
        return view('contacts.create')->with('contact',$contact)->with('companies',$companies);
    }

    function welcome (){
        return view('welcome');
    }

    public function edit($id){
        $contact = Contact::findOrFail($id);
        $companies = $this->companies->pluck();
        return view('contacts.edit')->with('contact',$contact)->with('companies',$companies);
    }
    public function update(Request $request , $id){
        $contact = Contact::findOrFail($id);
        $request->validate([
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'phone' => 'nullable',
            'address' => 'nullable',
            'company_id' => 'required|exists:companies,id',
        ]);

        $contact->update($request->all());

        return redirect()->route('contact.index')->with('message','Contact has been updated successfully');
    }
}
