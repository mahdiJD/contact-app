@extends('layouts.main')

@section('title', 'Contact App | Contact List')


@section('content')


<main class="py-5">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="card">
                <div class="card-header card-title">
                  <div class="d-flex align-items-center">
                    <h2 class="mb-0">All Contacts
                        @if(request()->query('trash'))
                            <small>(In Trash)</small>
                        @endif
                    </h2>
                    <div class="ml-auto">
                      <a href="{{ route('contacts.create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New</a>
                    </div>
                  </div>
                </div>
              <div class="card-body">
{{--                @include('contacts.partials.perPage')--}}
                @include('contacts.partials._filter', ['companies'=> $companies ])
                  @if($message = session('message'))
                      <div class="alert alert-success">{{$message}}
                        @if($undoRoute = session('undoRoute'))
                            <form action="{{$undoRoute}}" method="POST" style="display: inline">
                            @csrf
                            @method('delete')
                                <button class="btn btn-warning">Undo</button>
                            </form>
                        @endif
                      </div>
                  @endif
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">{!! sortable("First Name",'first_name') !!}</th>
                      <th scope="col">{!! sortable("Last Name") !!}</th>
                      <th scope="col">{!! sortable("Email") !!}</th>
                      <th scope="col">Company</th>
                      <th scope="col">Actions</th>
                    </tr>
                  </thead>


                    <tbody>

                    @php
                        $showTrashButton = request()->query('trash') ? true : false;
                    @endphp
                   @forelse($contacts as $index => $contact)
{{--                        @if($contact->company->name !== null)--}}
                        @include('contacts.partials._contact_row', ['contact'=> $contact, 'index' => $index])
{{--                        @endif--}}
                    @empty
                        @include('contacts.partials._empty_contact')
                    @endforelse

                     {{-- @each('contacts.partials._contact_row', $contacts, 'contact') --}}

                  </tbody>

                </table>


                {{-- {{ $contacts->appends(['orderBy'=>'ASC', 'q'=>'John'])->links() }} --}}

                {{-- {{ $contacts->appends(request()->only('orderBy', 'q'))->links() }} --}}

                {{ $contacts->withQueryString()->links() }}
                {{-- <nav class="mt-4">
                    <ul class="pagination justify-content-center">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                      </li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                      </li>
                    </ul>
                  </nav> --}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

@endsection('content')


