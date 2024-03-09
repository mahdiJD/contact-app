<?php

namespace App\Http\Controllers;

use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\search;


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
//        $this->perPage = request()->query('perPage');


//        DB::enableQueryLog();
        $contacts = Contact::latest()
            ->where(function ($query) {
                if ($companyId = request()->query('company_id')) {
                    $query->where('company_id', $companyId);
                }
            })->where(function ($query){
                if ($search = request()->query('search')){
                    $query->where('first_name','LIKE',"%{$search}%");
                    $query->orwhere('last_name','LIKE',"%{$search}%");
                    $query->orwhere('email','LIKE',"%{$search}%");
                }
            })
            ->paginate($this->perPage);
//        dump(DB::getQueryLog());

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

        Contact::create($request->all());

//        dd($request->all());
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
    public function update(Request $request , $id): RedirectResponse
    {
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

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return redirect()->route('contact.index')
            ->with('message','Contact has been move to the Trash successfully')
            ->with('undoRoute',route('contact.restore',$contact->id));
    }

    public function restore ($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();
        return redirect()->route('contact.index')
            ->with('message','Contact has been move to the Trash successfully restored from trash')
            ->with('undoRoute',route('contact.destroy',$contact->id));
    }

    public function forceDelete ($id)
    {
        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();
        return back()->route('contact.index')
            ->with('message','Contact has been remove from DB successfully.');
    }
}
