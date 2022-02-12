@extends('masterlayout.master_layout_login')
@section('content')
    <body>
    <div class="d-lg-flex half">
        <div class="bg order-1 order-md-2" style="background-image: url('logintheme/images/kantor_dukcapil.jpg');"></div>
        <div class="contents order-2 order-md-1">
            <div class="container">
                <div class="row align-items-center justify-content-center">
                    <div class="col-md-7">
                        <div align="center">
                            <img src="{{ asset('logintheme') }}/logo/logo_ksb.png" class="mb-4">
                            <br>
                            <h3>Login <strong>Admin Data</strong></h3>
                            <h5>Aplikasi Salam Dukcapil</h5>
                        </div>
                        <form action="{{route('cek_login_admin_data')}}" method="post">
                            @csrf
                            <div class="result">
                                @if(Session::get('error'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('error') }}
                                    </div>
                                @endif
                            </div>
                            <div class="form-group first">
                                <label for="nip">NIP</label>
                                <input name="nip" type="text" class="form-control @error('nip') is-invalid @enderror" placeholder="NIP Anda" id="nip">
                                @error('nip')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <div class="form-group last mb-3">
                                <label for="password">Password</label>
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password Anda" id="password">
                                @error('password')
                                <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <input type="submit" value="Masuk" class="btn btn-block btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
