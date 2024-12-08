@extends('superAdmin.layouts.app')

@section('content')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form action="{{ route('vendors.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xl-3 col-lg-4">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Add New User</h4>
                            </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                <div class="profile-img-edit position-relative">
                                    <img
                                    src="{{asset('/assets/images/avatars/01.png')}}"
                                    alt="profile-pic"
                                    class="theme-color-default-img profile-pic rounded avatar-100"
                                    />
                                    <img
                                    src="{{asset('/assets/images/avatars/avtar_1.png')}}"
                                    alt="profile-pic"
                                    class="theme-color-purple-img profile-pic rounded avatar-100"
                                    />
                                    <img
                                    src="{{asset('/assets/images/avatars/avtar_2.png')}}"
                                    alt="profile-pic"
                                    class="theme-color-blue-img profile-pic rounded avatar-100"
                                    />
                                    <img
                                    src="{{asset('/assets/images/avatars/avtar_4.png')}}"
                                    alt="profile-pic"
                                    class="theme-color-green-img profile-pic rounded avatar-100"
                                    />
                                    <img
                                    src="{{asset('/assets/images/avatars/avtar_5.png')}}"
                                    alt="profile-pic"
                                    class="theme-color-yellow-img profile-pic rounded avatar-100"
                                    />
                                    <img
                                    src="{{asset('/assets/images/avatars/avtar_3.png')}}"
                                    alt="profile-pic"
                                    class="theme-color-pink-img profile-pic rounded avatar-100"
                                    />
                                    <div class="upload-icone bg-primary">
                                    <svg
                                        class="upload-button icon-14"
                                        width="14"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                        fill="#ffffff"
                                        d="M14.06,9L15,9.94L5.92,19H5V18.08L14.06,9M17.66,3C17.41,3 17.15,3.1 16.96,3.29L15.13,5.12L18.88,8.87L20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18.17,3.09 17.92,3 17.66,3M14.06,6.19L3,17.25V21H6.75L17.81,9.94L14.06,6.19Z"
                                        />
                                    </svg>
                                    <input
                                        name="logo"
                                        class="file-upload @error('logo') is-invalid @enderror"
                                        type="file"
                                        accept="image/*"
                                    />
                                    @error('logo')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    </div>
                                </div>
                                <div class="img-extension mt-3">
                                    <div class="d-inline-block align-items-center">
                                    <span>Only</span>
                                    <a href="javascript:void();">.jpg</a>
                                    <a href="javascript:void();">.png</a>
                                    <a href="javascript:void();">.jpeg</a>
                                    <span>allowed</span>
                                    </div>
                                </div>
                                </div>
                                <div class="form-group">
                                <label class="form-label">User Role:</label>
                                <select
                                    name="type"
                                    class="selectpicker form-control"
                                    data-style="py-0"
                                >
                                    <option>Select</option>
                                    <option>Web Designer</option>
                                    <option>Web Developer</option>
                                    <option>Tester</option>
                                    <option>Php Developer</option>
                                    <option>Ios Developer</option>
                                </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="furl">Facebook Url:</label>
                                    <input
                                        name="facebook"
                                        type="text"
                                        class="form-control @error('facebook') is-invalid @enderror"
                                        id="furl"
                                        placeholder="Facebook Url"
                                    />
                                    @error('facebook')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="turl">Twitter Url:</label>
                                    <input
                                        name="twitter"
                                        type="text"
                                        class="form-control @error('twitter') is-invalid @enderror" 
                                        id="turl"
                                        placeholder="Twitter Url"
                                    />
                                    @error('twitter')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="instaurl"
                                        >Instagram Url:</label
                                    >
                                    <input
                                        name="insta"
                                        type="text"
                                        class="form-control @error('insta') is-invalid @enderror"
                                        id="instaurl"
                                        placeholder="Instagram Url"
                                    />
                                    @error('insta')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label class="form-label" for="lurl">Linkedin Url:</label>
                                    <input
                                    name="linkedin"
                                        type="text"
                                        class="form-control @error('linkedin') is-invalid @enderror"
                                        id="lurl"
                                        placeholder="Linkedin Url"
                                    />
                                    @error('linkedin')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-9 col-lg-8">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">New User Information</h4>
                            </div>
                            </div>
                            <div class="card-body">
                                <div class="new-user-info">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="fname"
                                                >First Name:
                                                </label
                                            >

                                            <input
                                                name="name"
                                                type="text"
                                                class="form-control @error('name') is-invalid @enderror "
                                                id="fname"
                                                placeholder="First Name"
                                            />
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="lname"
                                                >Last Name:</label
                                            >
                                            <input
                                                name="last"
                                                type="text"
                                                class="form-control @error('last') is-invalid @enderror"
                                                id="lname"
                                                placeholder="Last Name"
                                            />
                                            @error('last')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="lname"
                                                >Domain:</label
                                            >
                                            <input
                                                name="domain"
                                                type="text"
                                                class="form-control @error('domain') is-invalid @enderror"
                                                id="domain"
                                                placeholder="Domain"
                                            />
                                            @error('domain')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="lname"
                                                >Sub-Domain:</label
                                            >
                                            <input
                                                name="subdomain"
                                                type="text"
                                                class="form-control @error('subdomain') is-invalid @enderror"
                                                id="subdomain"
                                                placeholder="Sub-Domain"
                                            />
                                            @error('subdomain')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add1"
                                                >Street Address 1:</label
                                            >
                                            <input
                                                name="address"
                                                type="text"
                                                class="form-control  @error('address') is-invalid @enderror"
                                                id="add1"
                                                placeholder="Street Address 1"
                                            />
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="add2"
                                                >Street Address 2:</label
                                            >
                                            <input
                                                name="address2"
                                                type="text"
                                                class="form-control   @error('address2') is-invalid @enderror"
                                                id="add2"
                                                placeholder="Street Address 2"
                                            />
                                            @error('address2')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="cname"
                                                >Company Name:</label
                                            >
                                            <input
                                                name="company"
                                                type="text"
                                                class="form-control  @error('company') is-invalid @enderror"
                                                id="cname"
                                                placeholder="Company Name"
                                            />
                                            @error('company')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-sm-12">
                                            <label class="form-label">Country:</label>
                                            <select
                                                name="country"
                                                name="type"
                                                class="selectpicker form-control   @error('country') is-invalid @enderror"
                                                data-style="py-0"
                                            >
                                                <option>Select Country</option>
                                                <option>Caneda</option>
                                                <option>Noida</option>
                                                <option>USA</option>
                                                <option>India</option>
                                                <option>Africa</option>
                                            </select>
                                            @error('country')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="mobno"
                                                >Mobile Number:</label
                                            >
                                            <input
                                                name="mobile"
                                                type="text"
                                                class="form-control @error('mobile') is-invalid @enderror"
                                                id="mobno"
                                                placeholder="Mobile Number"
                                            />
                                            @error('mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="altconno"
                                                >Alternate Contact:</label
                                            >
                                            <input
                                                name="alt_mobile"
                                                type="text"
                                                class="form-control  @error('alt_mobile') is-invalid @enderror"
                                                id="altconno"
                                                placeholder="Alternate Contact"
                                            />
                                            @error('alt_mobile')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="email">Email:</label>
                                            <input
                                                name="email"
                                                type="email"
                                                class="form-control @error('email') is-invalid @enderror"
                                                id="email"
                                                placeholder="Email"
                                            />
                                            @error('email')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label class="form-label" for="pno">Pin Code:</label>
                                            <input
                                                name="pin"
                                                type="text"
                                                class="form-control @error('pin') is-invalid @enderror"
                                                id="pno"
                                                placeholder="Pin Code"
                                            />
                                            @error('pin')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label class="form-label" for="city"
                                                >Town/City:</label
                                            >
                                            <input
                                                name="city"
                                                type="text"
                                                class="form-control @error('city') is-invalid @enderror"
                                                id="city"
                                                placeholder="Town/City"
                                            />
                                            @error('city')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr />
                                    <h5 class="mb-3">Security</h5>
                                    <div class="row">
                                        <!-- <div class="form-group col-md-12">
                                            <label class="form-label" for="uname"
                                                >User Name:</label
                                            >
                                            <input
                                                type="text"
                                                class="form-control"
                                                id="uname"
                                                placeholder="User Name"
                                            />
                                            
                                        </div> -->
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="pass">Password:</label>
                                        <input
                                            name="password"
                                            type="password"
                                            class="form-control  @error('password') is-invalid @enderror"
                                            id="pass"
                                            placeholder="Password"
                                        />
                                        @error('password')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="rpass"
                                            >Repeat Password:</label
                                        >
                                        <input
                                            name="password_confirmation"
                                            type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="rpass"
                                            placeholder="Repeat Password "
                                        />
                                        @error('password_confirmation')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        </div>
                                    </div>
                                    <!-- <div class="checkbox">
                                        <label class="form-label"
                                        ><input
                                    name="linkedin"
                                            class="form-check-input me-2"
                                            type="checkbox"
                                            value=""
                                            id="flexCheckChecked"
                                        />Enable Two-Factor-Authentication</label
                                        >
                                    </div> -->
                                    <button type="submit" class="btn btn-primary">
                                        Add New User
                                    </button>
                                    <a href="{{ route('vendors.index') }}" class="btn btn-secondary">Cancel</a>
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
    </div>
@endsection

@push('styles')
    <!-- <style>
        body {
            background-color: #f8f9fa;
        }
        h1 {
            color: #007bff;
        }
    </style> -->
@endpush

@push('scripts')
    
@endpush
