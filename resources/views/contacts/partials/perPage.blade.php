<div class="row">
    <div class="col-md-6"></div>
    <div class="col-md-6">
        <div class="row">
            <div class="col" style="width: 100px ">
                <form method="GET">
                    <select class="custom-select" name="perPage" onchange="this.form.submit()">
                        <option value="10" selected>10</option>
                            <option value="5"
                                    @if( 5 == request()->query('perPage')) selected @endif
                            >5</option>
                    </select>
                </form>

            </div>

        </div>
    </div>
</div>
