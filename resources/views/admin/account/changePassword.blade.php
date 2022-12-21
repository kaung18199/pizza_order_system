@extends('admin.layouts.master')

@section('title','Category List Page')

@section('content')
    <div class="main-content">
        <div class="section__content section__content--p30">
            <div class="container-fluid">
                <div class="container-fluid">
                    <div class="row">
                    </div>
                    <div class="col-lg-6 offset-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Password</h3>
                                </div>
                                <hr>

                                @if (session('notMatch'))
                                    <div class="col-12">
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            <i class="fa-solid fa-triangle-exclamation"></i> {{session('notMatch')}}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                    </div>
                                @endif

                                <form action="{{ route('admin#changePassword') }}" method="post" novalidate="novalidate">
                                    @csrf
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Old password</label>
                                        <input id="cc-pament" name="oldPassword" type="password" class="form-control  @error('oldPassword')
                                            is-invalid
                                        @enderror" aria-required="true" aria-invalid="false" placeholder="Ender old password" >
                                        @error('oldPassword')
                                            <div class=" invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">New password</label>
                                        <input id="cc-pament" name="newPassword" type="password" class="form-control @error('newPassword')
                                            is-invalid
                                        @enderror" aria-required="true" aria-invalid="false" placeholder="Ender new password" >
                                        @error('newPassword')
                                            <div class=" invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label  class="control-label mb-1">Confirm password</label>
                                        <input id="cc-pament" name="confirmPassword" type="password" class="form-control @error('confirmPassword')
                                            is-invalid
                                        @enderror" aria-required="true" aria-invalid="false" placeholder="Ender confirm password" >
                                        @error('confirmPassword')
                                            <div class=" invalid-feedback">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                    <div>
                                        <button id="payment-button" type="submit" class="btn btn-lg btn-info btn-block">
                                            <i class="fa-solid fa-key"></i>   <span id="payment-button-amount">Change Password</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
