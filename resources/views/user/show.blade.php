@extends('layouts.vertical', ["page_title"=> "Users Management"])

@section('css')

@endsection

@section('content')
<!-- Start Content-->
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Users Management</a></li>
                        <li class="breadcrumb-item active">Show User</li>
                    </ol>
                </div>
                <h4 class="page-title">Show User</h4>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {{-- <h4 class="header-title">Basic Data Table</h4>
                    <p class="text-muted font-13 mb-4">
                        DataTables has most features enabled by default, so all you need to do to use it with your own tables is to call the construction
                        function:
                        <code>$().DataTable();</code>.
                    </p> --}}

                    <form class="needs-validation" action="{{ route('user.store') }}" method="post" novalidate>
                        @csrf
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <label for="name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Full Name" required />
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter full name.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Email" required />
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter email.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" placeholder="Username" required />
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter username.
                                    </div>
                                </div>
                                <div class="position-relative mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Password" required />
                                    <div class="valid-tooltip">
                                        Looks good!
                                    </div>
                                    <div class="invalid-tooltip">
                                        Please enter password.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="position-relative mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    {{-- <select class="form-control" name="role" id="role" multiple>
                                        @foreach ($roles as $role)
                                            <option value="{{ $role }}">{{ $role }}</option>
                                        @endforeach
                                    </select> --}}
                                    <ul class="list-group">
                                        @foreach ($roles as $role)
                                            {{-- <option value="{{ $role }}">{{ $role }}</option> --}}
                                            <li class="list-group-item">
                                                <input class="form-check-input me-1" type="checkbox" value="{{ $role }}" aria-label="{{ $role }}">
                                                {{ $role }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <button class="btn btn-primary mt-2" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div> <!-- container -->
@endsection

@section('script')
@endsection
