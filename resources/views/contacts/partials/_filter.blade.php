                <div class="row">
                  <div class="col-md-6"></div>
                  <div class="col-md-6">
                      <form method="GET">
                    <div class="row">
                      <div class="col">
                        @includeUnless(empty($companies) ,'contacts.partials._companies_select', ['companies' => $companies])
                      </div>
                      <div class="col">
                        <div class="input-group mb-3">
                          <input type="text"
                                 name="search"
                                 value="{{request()->query('search')}}"
                                 id="search-input"
                                 class="form-control"
                                 placeholder="Search..."
                                 aria-label="Search..."
                                 aria-describedby="button-addon2">
                          <div class="input-group-append">
                              @if(request()->filled('search') || request()->filled('company-id'))
                              <button class="btn btn-outline-secondary"
                              onclick="document.getElementById('search-input').value= '' ,
                              getElementById('search-select').selectedIndex=0 ,
                              this.form.submit()
                              ">
                                  <i class="fa fa-refresh"></i>
                                </button>
                              @endif
                            <button class="btn btn-outline-secondary" type="submit" id="button-addon2">
                              <i class="fa fa-search"></i>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                      </form>
                  </div>
                </div>
