<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Company;
use App\Repositories\CompanyRepository;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Pagination\LengthAwarePaginator;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\search;


class ContactController extends Controller
{

    public function __construct(
//        protected CompanyRepository $companies,
        protected $perPage = 10,
    ){}
    protected function userCompanies(){
        return Company::forUser(auth()->user())->orderBy('name')->pluck('name','id');
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

//        $companies = $this->companies->pluck();
        $companies = $this->userCompanies();
//        $this->perPage = request()->query('perPage');


//        DB::enableQueryLog();
//        $query = Contact::query();
//        if ( request()->query('trash')){
//            $query->onlyTrashed();
//            request()->merge([
//                'page' => 1
//            ]);
//        }

//        $contacts = $query->latest()

        // auth()->user()->contacts()->
        $contacts = Contact::
            allowedTrash()
            ->allowedSorts(['first_name','last_name','email'] , '-id')
//            ->allowedSorts('first_name')
//            ->filterByCompany('company_id')
            ->allowedFilter('company_id')
            ->allowedSearch('first_name','last_name','email')
            ->forUser(auth()->user())
            ->paginate($this->perPage);

//        dump(DB::getQueryLog());

//        $contactsCollection = Contact::latest()->get();
//        $perPage = 10;
//        $currentPage  = request()->query('page',1);
//        $items = $contactsCollection->slice( ($currentPage * $perPage) - $perPage , $perPage);
//        $total = $contactsCollection->count();
//
//        $contacts = new LengthAwarePaginator($items,$total,$perPage,$currentPage,
//            [
//                'path' => request()->url(),
//                'query' => request()->query(),
//            ]
//        );
        return view('contacts.index', ['contacts' => $contacts ,'companies'=>$companies]);// ->with('com');
    }

    public function store(ContactRequest $request){
//        Contact::create($request->all());
        $contact = request()->user()->contacts()->create($request->all());

//        dd($request->all());
        return redirect()->route('contacts.index')->with('message','Contact has been created successfully');
    }

    public function show (Contact $contact) {
//    if (not($id)) return view('contact.show');
//        $contacts = $this->getContact();
//        $contact = Contact::findOrFail($id);
//        abort_if(empty($contact) , 404);
        return view('contacts.show',['contact' => $contact]);
    }

    public  function create () {
        $companies =$this->userCompanies();
        $contact = new Contact();
        return view('contacts.create')->with('contact',$contact)->with('companies',$companies);
    }

    function welcome (){
        return view('welcome');
    }

    public function edit(Contact $contact){
//        $contact = Contact::findOrFail($id);
        $companies = $this->userCompanies();
        return view('contacts.edit')->with('contact',$contact)->with('companies',$companies);
    }
    public function update(ContactRequest $request , Contact $contact): RedirectResponse
    {
//        $contact = Contact::findOrFail($id);

        $contact->update($request->all());

        return redirect()->route('contacts.index')->with('message','Contact has been updated successfully');
    }

    public function destroy(Contact $contact)
    {
//        $contact = Contact::findOrFail($id);
        $contact->delete();
        $redirect = request()->query('redirect');
        return ($redirect ? redirect()->route($redirect):back())
            ->with('message','Contact has been move to the Trash successfully')
            ->with('undoRoute',$this->getUndoRoute('contacts.restore', $contact));
    }

    public function restore (Contact $contact)
    {
//        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->restore();
        $redirect = request()->query('redirect');
        return ($redirect ? redirect()->route($redirect):back())
            ->with('message','Contact has been move to the Trash successfully restored from trash')
            ->with('undoRoute',$this->getUndoRoute('contacts.destroy', $contact));
    }

    protected function getUndoRoute($name , $resource){
        return request()->missing('undo') ? route($name , [$resource->id , 'undo' => true]):null;
    }

    public function forceDelete (Contact $contact)
    {
//        $contact = Contact::onlyTrashed()->findOrFail($id);
        $contact->forceDelete();
        return back()
            ->with('message','Contact has been remove from DB successfully.');
    }
}
