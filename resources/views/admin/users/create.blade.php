@extends('admin.layout.master')
@section('title')
    Add New User
@endsection
@section('content')
    <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3 mt-3">
                    <label for="phone" class="form-label">Phone:</label>
                    <input type="number" name="phone" class="form-control" id="phone" placeholder="Enter phone">
                </div>
                <div class="mb-3 mt-3">
                    <label for="user_code" class="form-label">User_code:</label>
                    <input type="text" class="form-control" id="user_code" placeholder="Enter Usercode" name="user_code">
                </div>
                <div class="mb-3 mt-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
                </div>
                <div class="mb-3 mt-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
                </div>
                <div class="mb-3 mt-3">
                    <label for="photo_thumbs" class="form-label">Photo_thumbs:</label>
                    <input type="file" class="form-control" id="photo_thumbs" name="photo_thumbs">
                </div>
                <div class="mb-3 mt-3">
                    <label for="address" class="form-label">Address</label>
                    <select class="form-select form-select-sm mb-3" id="province" name="province_id">
                        <option value="" selected>Chọn tỉnh thành</option>
                    </select>
                    <select class="form-select form-select-sm mb-3" id="district" name="district_id">
                        <option value="" selected>Chọn quận huyện</option>
                    </select>
                    <select class="form-select form-select-sm" id="ward" name="ward_id">
                        <option value="" selected>Chọn phường xã</option>
                    </select>
                    <input type="text" name="address" placeholder="Số nhà, đường...">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3 mt-3">
                    <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" value="1" checked name="is_active">Is Active
                    </label>
                </div>
            </div>
        </div>
        <button type="submit" class="mt-3 btn btn-primary">Submit</button>
    </form>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.21.1/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var provinces = document.getElementById("province");
            var districts = document.getElementById("district");
            var wards = document.getElementById("ward");

            axios.get('/provinces')
                .then(function(response) {
                    var data = response.data;
                    renderOptions(provinces, data);
                })
                .catch(function(error) {
                    console.error(error);
                });

            provinces.onchange = function() {
                districts.length = 1;
                wards.length = 1;
                if (this.value != "") {
                    axios.get(`/districts/${this.value}`)
                        .then(function(response) {
                            var data = response.data;
                            renderOptions(districts, data);
                        })
                        .catch(function(error) {
                            console.error(error);
                        });
                }
            };

            districts.onchange = function() {
                wards.length = 1;
                if (this.value != "") {
                    axios.get(`/wards/${this.value}`)
                        .then(function(response) {
                            var data = response.data;
                            renderOptions(wards, data);
                        })
                        .catch(function(error) {
                            console.error(error);
                        });
                }
            };

            function renderOptions(selectElement, data) {
                for (const item of data) {
                    selectElement.options[selectElement.options.length] = new Option(item.name, item.id);
                }
            }
        });
    </script>
    <a href="{{ route('admin.users.index') }}" class="btn btn-warning mt-3">BACK TO LIST</a>
@endsection
