@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

    <div class="container">
        <div class="mt-5">
        <x-alert type="success" :session="session('success')"/>

            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-danger">ログアウト</button>
            </form>
        </div>
</body>
</html>