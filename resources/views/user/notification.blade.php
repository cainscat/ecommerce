@extends('layouts.app')
@section('style')
@endsection

@section('content')
<main class="main">
    <div class="page-header text-center">
        <div class="container">
            <h1 class="page-title">Notifications</h1>
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
                            <table class="table">
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr class="align-middle">
                                        <td style="padding: 10px;">
                                            <a style="{{ empty($value->is_read) ? 'color: red; font-weight:bold;' : 'color: #111fe3;' }}" href="{{ $value->url }}?noti_id={{ $value->id }}">
                                                {{ $value->message }}
                                            </a>
                                            <div>
                                                <small>{{ date('d-m-Y h:i A', strtotime($value->created_at)) }}</small>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
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
