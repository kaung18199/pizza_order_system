@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
    <div class="main-content">
        <div class="row">
            <div class="col-6 offset-2 mb-2">
                <a href="{{ route('admin#contactList') }}" class=" text-decoration-none text-dark">
                    <i class="fa-solid fa-arrow-left me-2"></i>Back
                </a>
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
                                <div class="card-title">
                                    <h3 class="text-center title-2">Message Detail</h3>
                                </div>
                                <hr>

                                <div class="row mb-3">
                                    <div class="row "><h5 class="col-3 offset-2">User Name</h5>
                                        <p class="col-6">{{ $data->name }}</p></div>
                                </div>
                                <div class="row mb-3">
                                    <div class="row "><h5 class="col-3 offset-2">User Email</h5>
                                        <p class="col-6">{{ $data->email }}</p></div>
                                </div><hr>
                                <div class="row mb-3">
                                    <div class="row "><h4 class="col-3 offset-5 mb-4">Message</h4>
                                        <p class="col-8 offset-2">{{ $data->message }}</p></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



