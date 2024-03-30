                <div class="row">
                  <div class="col-md-6">
                      <a
                          href="{{ request()->fullUrlWithQuery(['trash' => false ]) }}"
                         class="btn {{ !request()->query('trash') && request()->query('trash') == 0 ? 'btn-success' :
                            'btn-secondary'}}">ALL</a> |
                      <a href="{{ request()->fullUrlWithQuery(['trash' => true, 'page' => 1]) }}"
                         class="btn {{request()->query('trash') && request()->query('trash') == 1 ? 'btn-success' :
                            'btn-secondary'}}  ">Trash</a>
                  </div>
                  <div class="col-md-6">
                      <form method="GET">
                          <input type="hidden" name="trash" value="{{ request()->query('trash') }}">
                    <div class="row">
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
                              @if(request()->filled('search'))
                              <button class="btn btn-outline-secondary"
                              onclick="document.getElementById('search-input').value= '' ,
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
