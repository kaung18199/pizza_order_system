@extends('admin.layouts.master')

@section('title','Category List Page')

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
                                <div class=" ms-5">
                                    <i class="fa-solid fa-arrow-left text-dark" onclick="history.back()"></i>
                                </div>
                                <div class="card-title">
                                    <h3 class="text-center title-2">Change Role</h3>
                                </div>
                                <hr>

                                <form action="{{ route('admin#change',$account->id) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row">
                                        <div class=" col-4 offset-1">
                                            @if ($account->image == null)
                                                @if ($account->gender == 'male')
                                                <img src="{{ asset('image/dafault_user.jpg') }}" alt="" class=" img-thumbnail shadow-sm ">
                                                @else
                                                <img src="{{ asset('image/dafault_female_user.jpg') }}" alt="" class=" img-thumbnail shadow-sm ">
                                                @endif
                                            @else
                                                <img src="{{ asset('storage/'.$account->image) }}" alt="John Doe" />
                                            @endif

                                            {{-- <div class="mt-3">
                                                <input type="file" name="image" id="" class="@error('image') is-invalid @enderror form-control shadow-sm">
                                                @error('image')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div> --}}
                                            <div class="mt-3">
                                                <button type="submit" class=" btn btn-dark col-12 shadow-sm"><i class="fa-solid fa-wrench me-2"></i> Change</button>
                                            </div>
                                        </div>

                                        <div class="row col-6 ">
                                            <div class="form-group">
                                                <label  class="control-label mb-1 ">Name</label>
                                                <input id="cc-pament" name="name" type="text" value="{{ old('name',$account->name) }}" class="form-control shadow-sm @error('name')
                                                    is-invalid
                                                @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin Name"  disabled>
                                                @error('name')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1">Role</label>
                                                <select name="role" id="" class=" form-control shadow-sm">
                                                    <option value="admin" @if ($account->role == 'admin')
                                                        selected
                                                    @endif>Admin</option>
                                                    <option value="user" @if ($account->role == 'user')
                                                        selected
                                                    @endif>User</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1">Email</label>
                                                <input id="cc-pament" name="email" type="text" value="{{ old('email',$account->email) }}" class="form-control shadow-sm @error('email')
                                                    is-invalid
                                                @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin Email"  disabled>
                                                @error('email')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1">Phone</label>
                                                <input id="cc-pament" name="phone" type="text" value="{{ old('phone',$account->phone) }}" class="form-control shadow-sm @error('phone')
                                                    is-invalid
                                                @enderror" aria-required="true" aria-invalid="false" placeholder="Ender Admin Phone"  disabled>
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
                                                @enderror" disabled>
                                                    <option value="">Choose gender....</option>
                                                    <option value="male" @if($account->gender == 'male') selected @endif>Male</option>
                                                    <option value="female" @if($account->gender == 'female') selected @endif>Female</option>
                                                </select>
                                                @error('gender')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label  class="control-label mb-1">Address</label>
                                                <textarea name="address" disabled id="" cols="20" rows="5"  class=" form-control shadow-sm @error('address')
                                                    is-invalid
                                                @enderror" placeholder="Ender Admin Address">{{ old('address',$account->address) }}</textarea>
                                                @error('address')
                                                    <div class="invalid-feedback">
                                                        {{$message}}
                                                    </div>
                                                @enderror
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
