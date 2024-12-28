@extends('layouts.app')
@section('style')
<style>
    .box-btn{
        padding: 10px;
        text-align: center;
        border-radius: 5px;
        box-shadow: 0 0 1px rgba(0, 0, 0, .125), 0 1px 3px rgba(0, 0, 0, .2);
    }
</style>
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Dashboard</h1>
        </div>
    </div>

    <div class="page-content">
        <div class="dashboard">
            <div class="container">
                <br/>
                <div class="row">
                    @include('user._sidebar')
                    <div class="col-md-8 col-lg-9">
                        <div class="tab-content">
                            <div class="row">
                                <div class="col-md-3" style="margin-bottom: 10px;">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $TotalOrder }}</div>
                                        <div style="font-size: 15px;">Total Orders</div>
                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-bottom: 10px;">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $TotalTodayOrder }}</div>
                                        <div style="font-size: 15px;">Today Orders</div>
                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-bottom: 10px;">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">${{ number_format($TotalAmount) }}</div>
                                        <div style="font-size: 15px;">Total Amount</div>
                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-bottom: 10px;">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">${{ number_format($TotalTodayAmount) }}</div>
                                        <div style="font-size: 15px;">Today Amount</div>
                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-bottom: 10px;">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $TotalPending }}</div>
                                        <div style="font-size: 15px;">Pendding Orders</div>
                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-bottom: 10px;">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $TotalInprogress }}</div>
                                        <div style="font-size: 15px;">InProgress Orders</div>
                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-bottom: 10px;">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $TotalCompleted }}</div>
                                        <div style="font-size: 15px;">Completed Orders</div>
                                    </div>
                                </div>

                                <div class="col-md-3" style="margin-bottom: 10px;">
                                    <div class="box-btn">
                                        <div style="font-size: 20px; font-weight: bold;">{{ $TotalCancelled }}</div>
                                        <div style="font-size: 15px;">Cancelled Orders</div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
@endsection
