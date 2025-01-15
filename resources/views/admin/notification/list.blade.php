@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Contact Us</h3>
                </div>
                <div class="col-sm-6" style="text-align: right;">
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    @include('admin.layouts._message')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Notifications</h3>
                        </div>
                        <div class="card-body p-0">
                            <table class="table">
                                <thead>

                                </thead>
                                <tbody>
                                    @foreach ($getRecord as $value)
                                    <tr class="align-middle">
                                        <td>
                                            <a style="color: #000; {{ empty($value->is_read) ? 'font-weight:bold;' : '' }}" href="{{ $value->url }}?noti_id={{ $value->id }}">
                                                {{ $value->message }}
                                            </a>
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
