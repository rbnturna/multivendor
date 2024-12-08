@extends('superAdmin.layouts.app')

@section('content')
    <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div>
            <form action="{{ route('vendors.update', $vendor->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                                        class="file-upload"
                                        type="file"
                                        accept="image/*"
                                    />
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
                                    value="{{$vendor->facebook}}"
                                    type="text"
                                    class="form-control"
                                    id="furl"
                                    placeholder="Facebook Url"
                                />
                                </div>
                                <div class="form-group">
                                <label class="form-label" for="turl">Twitter Url:</label>
                                <input
                                    name="twitter"
                                    value="{{$vendor->twitter}}"
                                    type="text"
                                    class="form-control"
                                    id="turl"
                                    placeholder="Twitter Url"
                                />
                                </div>
                                <div class="form-group">
                                <label class="form-label" for="instaurl"
                                    >Instagram Url:</label
                                >
                                <input
                                    name="insta"
                                    value="{{$vendor->insta}}"
                                    type="text"
                                    class="form-control"
                                    id="instaurl"
                                    placeholder="Instagram Url"
                                />
                                </div>
                                <div class="form-group mb-0">
                                <label class="form-label" for="lurl">Linkedin Url:</label>
                                <input
                                    name="linkedin"
                                    value="{{$vendor->linkedin}}"
                                    type="text"
                                    class="form-control"
                                    id="lurl"
                                    placeholder="Linkedin Url"
                                />
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
                                            >First Name:</label
                                        >
                                        <input
                                            name="name"
                                            value="{{$vendor->name}}"
                                            type="text"
                                            class="form-control"
                                            id="fname"
                                            placeholder="First Name"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="lname"
                                            >Last Name:</label
                                        >
                                        <input
                                            name="last"
                                            value="{{$vendor->last}}"
                                            type="text"
                                            class="form-control"
                                            id="lname"
                                            placeholder="Last Name"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="lname"
                                            >Domain:</label
                                        >
                                        <input
                                            name="domain"
                                            value="{{$vendor->domain}}"
                                            type="text"
                                            class="form-control"
                                            id="domain"
                                            placeholder="Domain"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="lname"
                                            >Sub-Domain:</label
                                        >
                                        <input
                                            name="subdomain"
                                            value="{{$vendor->subdomain}}"
                                            type="text"
                                            class="form-control"
                                            id="subdomain"
                                            placeholder="Sub-Domain"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="add1"
                                            >Street Address 1:</label
                                        >
                                        <input
                                            name="address"
                                            value="{{$vendor->address}}"
                                            type="text"
                                            class="form-control"
                                            id="add1"
                                            placeholder="Street Address 1"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="add2"
                                            >Street Address 2:</label
                                        >
                                        <input
                                            name="address2"
                                            value="{{$vendor->address2}}"
                                            type="text"
                                            class="form-control"
                                            id="add2"
                                            placeholder="Street Address 2"
                                        />
                                        </div>
                                        <div class="form-group col-md-12">
                                        <label class="form-label" for="cname"
                                            >Company Name:</label
                                        >
                                        <input
                                            name="company"
                                            value="{{$vendor->company}}"
                                            type="text"
                                            class="form-control"
                                            id="cname"
                                            placeholder="Company Name"
                                        />
                                        </div>
                                        <div class="form-group col-sm-12">
                                        <label class="form-label">Country:</label>
                                        <select
                                            name="country"
                                            value="{{$vendor->country}}"

                                            name="type"
                                            class="selectpicker form-control"
                                            data-style="py-0"
                                        >
                                            <option>Select Country</option>
                                            <option>Caneda</option>
                                            <option>Noida</option>
                                            <option>USA</option>
                                            <option>India</option>
                                            <option>Africa</option>
                                        </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="mobno"
                                            >Mobile Number:</label
                                        >
                                        <input
                                            name="mobile"
                                            value="{{$vendor->mobile}}"
                                            type="text"
                                            class="form-control"
                                            id="mobno"
                                            placeholder="Mobile Number"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="altconno"
                                            >Alternate Contact:</label
                                        >
                                        <input
                                            name="alt_mobile"
                                            value="{{$vendor->alt_mobile}}"
                                            type="text"
                                            class="form-control"
                                            id="altconno"
                                            placeholder="Alternate Contact"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="email">Email:</label>
                                        <input
                                            name="email"
                                            value="{{$vendor->email}}"
                                            type="email"
                                            class="form-control"
                                            id="email"
                                            placeholder="Email"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="pno">Pin Code:</label>
                                        <input
                                            name="pin"
                                            value="{{$vendor->pin}}"
                                            type="text"
                                            class="form-control"
                                            id="pno"
                                            placeholder="Pin Code"
                                        />
                                        </div>
                                        <div class="form-group col-md-12">
                                        <label class="form-label" for="city"
                                            >Town/City:</label
                                        >
                                        <input
                                            name="city"
                                            value="{{$vendor->city}}"
                                            type="text"
                                            class="form-control"
                                            id="city"
                                            placeholder="Town/City"
                                        />
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
                                            name="linkedin"
                                            value="{{$vendor->linkedin}}"
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
                                            value=""
                                            type="password"
                                            class="form-control"
                                            id="pass"
                                            placeholder="Password"
                                        />
                                        </div>
                                        <div class="form-group col-md-6">
                                        <label class="form-label" for="rpass"
                                            >Repeat Password:</label
                                        >
                                        <input
                                            name="password_confirmation"
                                            value="{{$vendor->confirm}}"
                                            type="password"
                                            class="form-control"
                                            id="rpass"
                                            placeholder="Repeat Password "
                                        />
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
