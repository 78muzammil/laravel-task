<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-1">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5>Form</h5>
        </div>
        <div class="card-body p-3">
            <div class="feedback-success">
                @if(session('success'))
                    <div class="alert alert-success mt-3">
                        {{ session('success') }}
                    </div>
                @elseif(session('credentialError'))
                    <div class="alert alert-danger mt-3">
                        {{ session('credentialError') }}
                    </div>
                @endif
            </div>
           <div class="row g-4">
                <div class="col-md-6 offset-md-6 text-end">
                    <a href="{{ route('list') }}" class="btn btn-info">List</a>
                    <a href="{{ route('import.form') }}" class="btn btn-info">Import</a>
                </div>
            </div>
            <form action="{{route('save')}}" class="" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="@if($detail){{ $detail->id }}@endif">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="mb-2">Profile Image</label>
                        <input type="file" class="form-control @error('profile_image') is-invalid @enderror" name="profile_image" id="profileImage">
                        @error('profile_image')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <div class="mt-3">
                            @if($detail && $detail->profile_image)
                            <img src="{{ file_exists(public_path('profile_images/'.$detail->profile_image)) ? asset('profile_images/'.$detail->profile_image) : asset('no-image.jpg') }}" style="max-width: 200px; height:200px;">
                            @else
                            <img id="profilePreviewImage" src="#" alt="Profile Image Preview" class="img-thumbnail" style="display: none; max-width: 100px; height: auto;">
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">Name </label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" id="name" placeholder="Name" value="{{ old('name', $detail->name ?? '') }}">
                        @error('name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div> 
                    <div class="col-md-6">
                        <label class="mb-2">Phone </label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="+1-(XXX) XXX-XXXX" value="{{ old('phone', $detail->phone ?? '') }}">
                        @error('phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" placeholder="Email" value="{{ old('email', $detail->email ?? '') }}">
                        @error('email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">Street Address</label>
                        <textarea  class="form-control @error('address') is-invalid @enderror" name="address" id="address" placeholder="Address" rows="4" cols="3">{{ old('address', $detail->street_address ?? '') }}</textarea>
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">City </label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" id="city" placeholder="City" value="{{ old('city', $detail->city ?? '') }}">
                        @error('city')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">State</label>
                        <select name="state" class="form-control @error('state') is-invalid @enderror">
                            <option value="">-- select State --</option>
                            <option value="CA" {{ (old("state") === "CA" || (!empty($detail->state) && $detail->state === 'CA')) ? 'selected' : '' }}>CA</option>
                            <option value="NY" {{ (old("state") === "NY" || (!empty($detail->state) && $detail->state === 'NY')) ? 'selected' : '' }}>NY</option>
                            <option value="AT" {{ (old("state") === "AT" || (!empty($detail->state) && $detail->state === 'AT')) ? 'selected' : '' }}>AT</option>
                        </select>
                        @error('state')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label class="mb-2">Country</label>
                        <select name="country" class="form-control @error('country') is-invalid @enderror">
                            <option value=" ">-- select country --</option>
                            <option value="IN" {{ (old("country") === "IN" || (!empty($detail->country) && $detail->country === 'IN')) ? 'selected' : '' }}>IN</option>
                            <option value="US" {{ (old("country") === "US" || (!empty($detail->country) && $detail->country === 'US')) ? 'selected' : '' }}>US</option>
                            <option value="EU" {{ (old("country") === "EU" || (!empty($detail->country) && $detail->country === 'EU')) ? 'selected' : '' }}>EU</option>
                        </select>
                        @error('country')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('#profileImage').on('change', function () {
            const profileImage = this;
            const profilePreviewImage = $('#profilePreviewImage');

            if (profileImage.files && profileImage.files[0]) {
                const reader = new FileReader();

                reader.onload = function (e) {
                    profilePreviewImage.attr('src', e.target.result);
                    profilePreviewImage.show();
                };

                reader.readAsDataURL(profileImage.files[0]);
            } else {
                profilePreviewImage.hide();
            }
        });

        $('#phone').on('input', function () {
            let phoneNumber = $(this).val();
            phoneNumber = phoneNumber.replace(/[^\d+]/g, '');
            if (phoneNumber.startsWith('+1')) {
                phoneNumber = phoneNumber.replace(/(\+1)(\d{3})(\d{3})(\d{4})$/, '$1-($2) $3-$4');
            } else if (phoneNumber.length > 1) {
                phoneNumber = '+1-' + phoneNumber.replace(/(\d{3})(\d{3})(\d{4})$/, '($1) $2-$3');
            }
            $(this).val(phoneNumber);
        });
    });
</script>
</body>
</html>
