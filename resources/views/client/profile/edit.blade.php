@extends('client.layout.inheritance')

@section('content')
<div class="product-content mt-5">
    <div class="container">
        <h2 class="text-center">Profile</h2>
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <nav>
            <ul class="nav nav-tabs nav-tabs-custom nav-success" id="nav-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="nav-additional-tab" data-bs-toggle="tab" href="#nav-additional" role="tab" aria-controls="nav-additional" aria-selected="true">Edit Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="nav-detail-tab" data-bs-toggle="tab" href="#nav-detail" role="tab" aria-controls="nav-detail" aria-selected="false">Details</a>
                </li>
            </ul>
        </nav>
        <div class="tab-content border border-top-0 p-4 rounded shadow" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-additional" role="tabpanel" aria-labelledby="nav-additional-tab">
                <div class="row">
                    <div class="col-md-4 text-center ">
                        <div class="profile-pic  text-center">
                            <img id="profileImage" src="{{ $user->photo_thumbs ? Storage::url($user->photo_thumbs) : asset('images/banner/Avatardf.jpg')  }}" class="img-fluid rounded-circle  shadow" alt="Profile Picture">
                            <h3 class="font-weight-bold">{{ old('fullname', $user->fullname) }}</h3> 
                            <h5 class="text-muted">{{ old('email', $user->email) }}</h5>
                            <div class="overlay">
                                <label for="photoInput" class=" btn-primary text-white text-xxl">Change Photo</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <form action="{{ route('client.profile.update', ['id' => $user->id]) }}" method="POST" enctype="multipart/form-data" class="p-4 ">
                            @csrf
                            @method('PUT')
                            <div class="table-responsive">
                                <table class="table mb-0">
                                    <tbody>
                                        <tr>
                                            <th scope="row" style="width: 200px;">Full Name</th>
                                            <td><input type="text" class="form-control" id="fullname" name="fullname" value="{{ old('fullname', $user->fullname) }}" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Email</th>
                                            <td><input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Phone</th>
                                            <td><input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $user->phone) }}" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Address</th>
                                            <td><input type="text" class="form-control" id="address" name="address" value="{{ old('address', $user->address) }}" required></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Photo</th>
                                            <td><input type="file" class="form-control" id="photoInput" name="photo_thumbs"></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn rounded-5 mt-3">Update Profile</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="nav-detail" role="tabpanel" aria-labelledby="nav-detail-tab">
                <div>
                    <h5 class="font-size-16 mb-3">Patterns arts & culture</h5>
                    <p>Cultural patterns are the similar behaviors within similar situations we witness due to shared beliefs, values, norms and social practices that are steady over time. In art, a pattern is a repetition of specific visual elements. The dictionary.com definition of "pattern" is: an arrangement of repeated or corresponding parts, decorative motifs, etc.</p>
                    <div>
                        <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> On digital or printed media</p>
                        <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> For commercial and personal projects</p>
                        <p class="mb-2"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> From anywhere in the world</p>
                        <p class="mb-0"><i class="mdi mdi-circle-medium me-1 text-muted align-middle"></i> Full copyrights sale</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .profile-pic {
        position: relative;
        display: inline-block;
        width: 200px;
        height: 200px;
    }
    .profile-pic img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
    }
    .profile-pic .overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s;
        border-radius: 50%;
    }
    .profile-pic:hover .overlay {
        opacity: 2;
       
    }
    .profile-pic .overlay label {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }
    .form-control {
        border-radius: 10px;
    }
    .btn-primary {
        border-radius: 98px;
        background-color: rgba(206, 212, 218, 0.2);
        
    }
    .btn-primary:hover {
        border-radius: 98px;
        background-color: rgba(0, 0, 0, 0.5);
        
    }
    
</style>
@endsection

@section('scripts')
<script>
    document.getElementById('photoInput').onchange = function (evt) {
        const [file] = evt.target.files;
        if (file) {
            document.getElementById('profileImage').src = URL.createObjectURL(file);
        }
    }
</script>
@endsection
