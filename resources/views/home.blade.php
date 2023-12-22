@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
    
                    @if(Auth::user()->role_id == 1)
                        <span onClick="goToDashboard()" style="cursor: pointer;">
                            {{ __('Welcome back, ') }} {{ Auth::user()->name }}!
                        </span>
                    @elseif(Auth::user()->role_id == 2)
                        <span onClick="goToShop()" style="cursor: pointer;">
                            {{ __('Welcome back, ') }} {{ Auth::user()->name }}!
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function goToDashboard() {
        window.location.href = 'http://localhost:3000/admin/dashboard';
        return false;
    }
    function goToShop() {
        window.location.href = 'http://localhost:3000';
        return false;
    }
</script>
@endsection
