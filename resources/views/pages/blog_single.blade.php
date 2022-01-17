@extends('layouts.app')

@section('content')


    @foreach ($posts as $row)
        <div class="single_post">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 offset-lg-2">
                        <div class="single_post_title">
                            @if (Session()->get('lang') == 'arabic')
                                <h3 style=" text-align: right; border: 2px solid rgb(14,140,228);
								border-radius: 25px;padding-right:10px;">{{ $row->post_title_ar }}</h3>
                            @else
                                <h3 style="border: 2px solid rgb(14,140,228);
								border-radius: 25px;padding-left:10px;">{{ $row->post_title_en }}</h3>
                            @endif
                        </div>


                        <div class="single_post_text">
                            @if (Session()->get('lang') == 'arabic')
                                <p style="text-align: right;">{!! $row->details_ar !!}</p>
                            @else
                                <p>{!! $row->details_en !!}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach




@endsection
