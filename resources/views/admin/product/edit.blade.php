@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-3 offset-7 mb-2">
                @if (session('updateSuccess'))
                    <div class="">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa-solid fa-circle-check"></i> {{session('updateSuccess')}}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row">
                    </div>
                    <div class="col-lg-10 offset-1">
                        <div class="card">
                            <div class="card-body">
                                <div class=" ms-5">
                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                </div>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Pizza Details</h3>
                                </div>
                                <hr>

                                <div class="row">
                                    <div class="col-3 offset-2 mt-2">
                                        <img src="{{ asset('storage/'.$pizza->image) }}" alt="John Doe" class=" img-thumbnail shadow-sm"/>
                                    </div>
                                    <div class="col-7 mb-5">

                                          <h3 class=" my-3 p-2  me-2 d-block w-50 bg-success text-center rounded-pill text-white">{{ $pizza->name }}</h3>
                                          <span class=" my-3 p-2 btn btn-dark text-white rounded-pill me-2"><i class="fa-solid fa-diagram-next me-2"></i>{{ $pizza->category_name }}</span>
                                            <span class=" my-3 p-2 btn rounded-pill btn-dark text-white me-2"><i class="fa-solid fs-5 fa-money-bill-1-wave me-2"></i>{{ $pizza->price }} kyats</span>
                                            <span class=" my-3 p-2 btn rounded-pill btn-dark text-white me-2"><i class="fa-solid fs-5 fa-clock me-2"></i>{{ $pizza->waiting_time}} mins</span>
                                             <span class=" my-3 p-2 btn btn-dark rounded-pill text-white me-2"><i class="fa-solid fs-5 fa-eye me-2"></i>{{ $pizza->view_count }}</span>
                                             <span class=" my-3 p-2 rounded-pill btn btn-dark text-white me-2"><i class="fa-solid fs-5 fa-user-clock me-2"></i>{{ $pizza->created_at->format('j-F-Y') }}</span>

                                         <div class="my-3 p-2 me-2"><i class="fa-solid fs-5 fa-file-lines me-2"></i>Detail</div>
                                        <div class="">{{ $pizza->description }}</div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
