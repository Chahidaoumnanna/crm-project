@extends('base')

@section('title', 'Create client')

@section('bodyTitle', 'Create client')

@section('body')
    <div class="p-4 bg-light" data-bs-theme="{{ session('theme', 'light') }}">
        <!-- Toastr Notification -->
        @if(session('success'))
            <script>
                toastr.success("{{ session('success') }}", "Succès", {
                    closeButton: true,
                    progressBar: true,
                    positionClass: "toast-top-right",
                    timeOut: 5000,
                });
            </script>
        @endif

        <form action="{{ route('clients.store') }}" method="post">
            @csrf
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                        <label class="form-label">Name</label>
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                        <label class="form-label">Email</label>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}">
                        <label class="form-label">Phone</label>
                        @error('phone')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <input type="text" class="form-control" id="address" name="address" value="{{ old('address') }}">
                        <label class="form-label">Address</label>
                        @error('address')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group input-group-outline my-3">
                        <select class="form-control" id="type" name="type">
                            <option value="">Select type</option>
                            <option value="individual">Individual</option>
                            <option value="company">Company</option>
                            <option value="other">Other</option>
                        </select>
                        <label class="form-label">Type</label>
                        @error('type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
@endsection
