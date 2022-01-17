@extends('admin.admin_layouts')



@section('admin_content')

    <!-- ########## START: MAIN PANEL ########## -->
    <div class="sl-mainpanel">
        <nav class="breadcrumb sl-breadcrumb">
            <a class="breadcrumb-item" href="index.html">Starlight</a>
            <span class="breadcrumb-item active">Product Section</span>
        </nav>

        <div class="sl-pagebody">
            <div class="card pd-20 pd-sm-40">
                <h6 class="card-body-title"> Product Deatils Page
                </h6>

                    <div class="form-layout">
                        <div class="row mg-b-25">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Name: <span
                                            class="tx-danger">*</span></label><br>
                                    <strong>{{ $product->product_name }}</strong>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Code: <span
                                            class="tx-danger">*</span></label><br>
                                    <strong>{{ $product->Product_code }}</strong>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Quantitiy: <span
                                            class="tx-danger">*</span></label><br>
                                    <strong>{{ $product->Product_quantitiy }}</strong>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Discount Price: <span
                                            class="tx-danger">*</span></label><br>
                                    <strong>{{ $product->discount_price}}</strong>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Category: <span
                                            class="tx-danger">*</span></label>
                                    <br>
                                    <strong>{{ $product->category_name }}</strong>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Sub Category: <span
                                            class="tx-danger">*</span></label>
                                    <br>
                                    <strong>{{ $product->subcategory_name }}</strong>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group mg-b-10-force">
                                    <label class="form-control-label">Brand: <span class="tx-danger">*</span></label>
                                    <br>
                                    <strong>{{ $product->brand_name }}</strong>
                                </div>
                            </div><!-- col-4 -->
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Size: <span
                                            class="tx-danger">*</span></label>
                                    <br>
                                    <strong>{{ $product->Product_size }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Product Color: <span
                                            class="tx-danger">*</span></label>
                                    <br>
                                    <strong>{{ $product->Product_color }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="form-control-label">Selling Price: <span
                                            class="tx-danger">*</span></label>
                                    <br>
                                    <strong>{{ $product->selling_price }}</strong>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Product Details: <span
                                            class="tx-danger">*</span></label>
                                    <br>
                                    <p>{!! $product->Product_details !!}</p>
                                </div>
                            </div><!-- col-4 -->

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="form-control-label">Video Link: <span
                                            class="tx-danger">*</span></label>
                                    <br>
                                    <strong>{{ $product->video_link }}</strong>
                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group" style="position:relative;
                                    padding:0;
                                    margin-bottom: 10px;">
                                    <label class="form-control-label">Image One ( Main Thumbnail): <span class="tx-danger">*</span></label><br>
                                    <label class="custom-file">
                                        <img src="{{ URL::to($product->image_one) }}" style="height: 80px;width: 80px;" alt="">
                                    </label>

                                </div>
                            </div><!-- col-4 -->


                            <div class="col-lg-4">
                                <div class="form-group" style="position:relative;
                                    padding:0;
                                    margin-bottom: 10px;">
                                    <label class="form-control-label">Image Two: <span class="tx-danger">*</span></label><br>
                                    <label class="custom-file">
                                        <img src="{{ URL::to($product->image_two) }}" style="height: 80px;width: 80px;" alt="">
                                    </label>

                                </div>
                            </div><!-- col-4 -->




                            <div class="col-lg-4">
                                <div class="form-group" style="position:relative;
                                    padding:0;
                                    margin-bottom: 10px;">
                                    <label class="form-control-label">Image Three: <span class="tx-danger">*</span></label><br>
                                    <label class="custom-file">
                                        <<img src="{{ URL::to($product->image_three) }}" style="height: 80px;width: 80px;" alt="">
                                    </label>

                                </div>
                            </div><!-- col-4 -->

                        </div><!-- row -->

                        <hr>
                        <br><br>

                        <div class="row">
                            <div class="col-lg-4">
                                <label >
                                    @if($product->main_slider == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Active</span>
                                        @endif
                                    <span>Main Slider</span>
                                </label>
                            </div>

                            <div class="col-lg-4">
                                <label >
                                    @if($product->main_slider == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Active</span>
                                    @endif
                                    <span>Hot Deals</span>
                                </label>
                            </div>

                            <div class="col-lg-4">
                                <label >
                                    @if($product->main_slider == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Active</span>
                                    @endif
                                    <span>Best Rated</span>
                                </label>
                            </div>

                            <div class="col-lg-4">
                                <label >
                                    @if($product->main_slider == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Active</span>
                                    @endif
                                    <span>Trends Product</span>
                                </label>
                            </div>

                            <div class="col-lg-4">
                                <label >
                                    @if($product->main_slider == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Active</span>
                                    @endif
                                    <span>Middle Slider</span>
                                </label>
                            </div>

                            <div class="col-lg-4">
                                <label >
                                    @if($product->main_slider == 1)
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Active</span>
                                    @endif
                                    <span>Hot New</span>
                                </label>
                            </div>
                        </div>

                    </div><!-- form-layout -->
            </div><!-- card -->
        </div>

    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->


@endsection
