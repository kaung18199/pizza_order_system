@extends('user.layouts.master')

@section('content')

@if (session('success'))
<div class="col-4 offset-4">
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fa-solid fa-circle-check"></i> {{session('success')}}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
    <!-- Cart Start -->
    <div class="container-fluid" style="height: 400px">
        <div class="row px-xl-5">
            <div class="col-lg-6 offset-3 table-responsive mb-5 shadow border rounded mt-5" >
                <form action="{{ route('user#messageSend') }}" method="post" novalidate="novalidate">
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label  class="control-label mb-1">Name</label>
                            <input id="cc-pament" name="userName" type="text" class="form-control @error('userName')
                                is-invalid
                            @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood..." value="{{ Auth::user()->name }}">
                            @error('userName')
                                <div class=" invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-6">
                            <label  class="control-label mb-1">Email</label>
                            <input id="cc-pament" name="userEmail" type="text" class="form-control @error('userEmail')
                                is-invalid
                            @enderror" aria-required="true" aria-invalid="false" placeholder="Seafood..." value="{{ Auth::user()->email }}">
                            @error('userEmail')
                                <div class=" invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label  class="control-label mb-1">Message</label>
                        <textarea name="userMessage" id="" cols="10" rows="5" class="form-control @error('userMessage')
                            is-invalid
                        @enderror">
                        </textarea>
                        @error('userMessage')
                            <div class=" invalid-feedback">
                                {{$message}}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3 col-4 offset-8" >
                        <button id="payment-button" type="submit" class="btn btn-lg btn-warning btn-block">
                            <span id="payment-button-amount">SEND</span>
                            {{-- <span id="payment-button-sending" style="display:none;">Sending…</span> --}}
                            <i class="fa-solid fa-paper-plane"></i>
                        </button>
                    </div>
                </form>

            </div>

        </div>
    </div>
    <!-- Cart End -->

@endsection


