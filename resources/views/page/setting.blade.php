@extends('layouts.app')
@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="card p-3 overlay-wrapper">
                        <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Loading...</div>
                        </div>

                        <div class="card-body">
                            <div class="d-flex justify-content-center">
                                <img src="{{ asset('storage/app/images/app/' . $data->logo) ?? asset('storage/app/images/app/logo.png') }}"
                                    alt="logo" class="img-fluid img-thumbnail px-4">
                            </div>
                            <div class="d-flex justify-content-center">
                                <b class="text-center">Logo Aplikasi</b>
                            </div>

                        </div>
                        <form action="{{ route('setting.logo.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="input-group d-none">
                                <div class="custom-file">
                                    <input name="app_logo" type="file" class="custom-file-input" id="inputLogo">
                                    <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                                <button type="submit" class="d-none" id="btnUpload"></button>
                            </div>
                        </form>
                    </div>

                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Loading...</div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('setting.app.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="app_name">Nama Aplikasi</label>
                                        <input type="text" name="app_name" class="form-control"
                                            value="{{ $data->name }}">
                                        <label for="app_name">Ganti password</label>
                                        <input type="text" name="old_password" id="old_password" class="form-control"
                                            placeholder="Password Lama">
                                        <span class="invalid-feedback">Password Tidak Sesuai</span>
                                        <input type="text" name="password" class="form-control mt-2"
                                            placeholder="Password baru">
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <a href="{{ route('dashboard') }}" class="btn btn-secondary submit mr-1">Back</a>
                                        <button type="submit" class="btn btn-primary submit btn-submit">Save</button>
                                    </div>
                                </div>
                            </form>

                        </div>
                    </div>
                    <div class="card">
                        <div class="overlay"><i class="fas fa-3x fa-sync-alt fa-spin"></i>
                            <div class="text-bold pt-2">Loading...</div>
                        </div>
                        <div class="card-body">
                            <table id="example" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Username</th>
                                        <th>Role</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $no = 1;
                                    @endphp
                                    @forelse ($access as $item)
                                        <tr>
                                            <td>{{ $no++ }}</td>
                                            <td>{{ $item->username }}</td>
                                            <td>
                                                @foreach ($item->roles as $role)
                                                    {{ $role->name }}
                                                @endforeach
                                            </td>
                                            <td>
                                                @if ($item->status == '1')
                                                    <div class="badge badge-primary">Active</div>
                                                @else
                                                    <div class="badge badge-danger">Non-Active</div>
                                                @endif

                                            </td>
                                            <td>
                                                <div class="d-flex justify-content-between">
                                                    <div class="btn btn-success"><i class="fa fa-edit"></i></div>
                                                    <div class="btn btn-danger delete" data-id="{{ $item->id }}"
                                                        data-name="{{ $item->name }}"><i class="fa fa-trash"></i></div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty

                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $("#customSwitch3").click(function() {
            let status = $("#customSwitch3").val()
            console.log(status);
        })
        $('.img-thumbnail').click(function(e) {
            $('#inputLogo').click();
        });
        $('#inputLogo').change(function(e) {
            var files = $('#inputLogo')[0].files;
            $(".overlay").show();
            if (files.length > 0) {
                $("#btnUpload").click();
            }
        });
        $('#old_password').keyup(function(e) {
            let password = $('#old_password').val();
            $.ajax({
                type: "get",
                url: "{{ route('setting.app.cekpassword') }}",
                data: "old_password=" + password,
                success: function(response) {
                    if (response == false) {
                        $('#old_password').addClass('is-invalid');
                    } else {
                        $('#old_password').removeClass('is-invalid');
                    }
                },
            });
        });
    </script>
@endsection
