@extends('admin.layouts.app')
    @section('style')
    @endsection
@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">SMTP Setting</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    @include('admin.layouts._message')
                    <div class="card card-primary">
                        <form action="" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="card-body">

                                <div class="form-group">
                                    <label>Website Name <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->name }}" name="name">
                                </div>

                                <div class="form-group">
                                    <label>Mail Mailer <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->mail_mailer }}" name="mail_mailer">
                                </div>

                                <div class="form-group">
                                    <label>Mail Host <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->mail_host }}" name="mail_host">
                                </div>

                                <div class="form-group">
                                    <label>Mail Port <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->mail_port }}" name="mail_port">
                                </div>

                                <div class="form-group">
                                    <label>Mail Username <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->mail_username }}" name="mail_username">
                                </div>

                                <div class="form-group">
                                    <label>Mail Password <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->mail_password }}" name="mail_password">
                                </div>

                                <div class="form-group">
                                    <label>Mail Encyption <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->mail_encryption }}" name="mail_encryption">
                                </div>

                                <div class="form-group">
                                    <label>Mail From Address <span style="color: red"></span></label>
                                    <input type="text" class="form-control" value="{{ $getRecord->mail_from_address }}" name="mail_from_address">
                                </div>

                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('script')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

<script>
    //Text editor
    $(document).ready(function() {
            $('.editor').summernote({
                placeholder: 'Enter here...',
                tabsize: 2,
                height: 100
            });
        });
</script>
@endsection
