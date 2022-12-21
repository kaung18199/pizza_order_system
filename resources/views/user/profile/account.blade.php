@extends('user.layouts.master')

@section('content')

<div class="main-content">
    <div class="section__content section__content--p30">
        <div class="container-fluid">
            <div class="container-fluid">
                <div class="row">
                </div>
                <div class="col-lg-10 offset-1">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">
                                <h3 class="text-center title-2">Account Profile</h3>
                            </div>
                            <hr>

                            @if (session('updateSuccess'))
                                <div class="col-3 offset-8">
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <i class="fa-solid fa-circle-check me-2"></i> {{session('updateSuccess')}}
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('user#accountChange',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class=" col-4 offset-1">
                                        @if (Auth::user()->image == null)
                                            @if (Auth::user()->gender == 'male')
                                            <img src="{{ asset('image/dafault_user.jpg') }}" alt="" class=" img-thumbnail  shadow ">
                                            @else
                                            <img src="{{ asset('image/dafault_female_user.jpg') }}" alt="" class=" img-thumbnail shadow ">
                                            @endif
                                        @else
                                            <img src="{{ asset('storage/'.Auth::user()->image) }}" alt="John Doe" class=" img-thumbnail w-100"/>
                                        @endif

                                        <div class="mt-3">
                                            <input type="file" name="image" id="" class="@error('image') is-invalid @enderror form-control shadow-sm">
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="mt-3">
                                            <button type="submit" class=" btn btn-dark col-12 shadow-sm"><i class="fa-solid fa-wrench me-2"></i>  Update</button>
                                        </div>
                                    </div>

                                    <div class="row col-6 ">
                                        <div class="form-group">
                                            <label  class="control-label mb-1 ">Name</label>
                                            <input id="cc-pament" name="name" type="text" value="{{ old('name',Auth::user()->name) }}" class="form-control shadow-sm @error('name')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin Name" >
                                            @error('name')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Email</label>
                                            <input id="cc-pament" name="email" type="text" value="{{ old('email',Auth::user()->email) }}" class="form-control shadow-sm @error('email')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin Email" >
                                            @error('email')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Phone</label>
                                            <input id="cc-pament" name="phone" type="text" value="{{ old('phone',Auth::user()->phone) }}" class="form-control shadow-sm @error('phone')
                                                is-invalid
                                            @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin Phone" >
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Gender</label>
                                            <select name="gender" class="form-control shadow-sm @error('gender')
                                                is-invalid
                                            @enderror">
                                                <option value="">Choose gender....</option>
                                                <option value="male" @if(Auth::user()->gender == 'male') selected @endif>Male</option>
                                                <option value="female" @if(Auth::user()->gender == 'female') selected @endif>Female</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Address</label>
                                            <textarea name="address" id="" cols="20" rows="5"  class=" form-control shadow-sm @error('address')
                                                is-invalid
                                            @enderror" placeholder="Ender Admin Address">{{ old('address',Auth::user()->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label  class="control-label mb-1">Role</label>
                                            <input id="cc-pament" name="role" type="text" class="form-control shadow-sm " aria-required="true" value="{{Auth::user()->role}}" aria-invalid="false" placeholder="Admin" disabled>
                                        </div>
                                    </div>
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


