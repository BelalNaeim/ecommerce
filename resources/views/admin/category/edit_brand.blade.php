@extends('admin.admin_layouts')

@section('admin_content')
    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <div class="sl-pagebody">
            <div class="sl-page-title">
                <h5>Brand Update</h5>
            </div><!-- sl-page-title -->

            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title">Brand Upadte
                </h6>
                <div class="table-wrapper">
					@if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url('update/brand/'.$brand->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body pd-20">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Brand Name </label>
                            <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Brand">
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Brand Logo </label>
                            <input type="file" class="form-control" name="brand_logo" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Brand Logo">
                        </div>
						<div class="form-group">
                            <label for="exampleInputEmail1">Old Brand Logo </label>
							<img src="{{ URL::to($brand->brand_logo) }}" height="70px" width="90px" alt="brand_logo">
							<input type="hidden" name="old_logo" value="{{ $brand->brand_logo }}">
                        </div>
                    </div><!-- modal-body -->
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-info pd-x-20">Update</button>
                    </div>
                </form>
            </div>
        </div><!-- modal-dialog -->
    </div><!-- modal -->

@endsection
