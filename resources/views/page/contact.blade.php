@extends('layouts.app')
@section('content')
<main class="main">
    <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
        <div class="container">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">{{ $getPage->title }}</li>
            </ol>
        </div>
    </nav>
    <div class="container">
        <div class="page-header page-header-big text-center" style="background-image: url('{{ $getPage->getImage() }}')">
            <h1 class="page-title text-white">{{ $getPage->title }}</h1>
        </div>
    </div>

    <div class="page-content pb-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 mb-2 mb-lg-0">
                    {!! $getPage->description !!}
                    <div class="row">
                        <div class="col-sm-7">
                            <div class="contact-info">
                                <h3></h3>

                                <ul class="contact-list">
                                    @if(!empty($getSystemSetting->address))
                                        <li>
                                            <i class="icon-map-marker"></i>
                                            {{ $getSystemSetting->address }}
                                        </li>
                                    @endif

                                    @if(!empty($getSystemSetting->phone))
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="tel:{{ $getSystemSetting->phone }}">{{ $getSystemSetting->phone }}</a>
                                        </li>
                                    @endif

                                    @if(!empty($getSystemSetting->phone_two))
                                        <li>
                                            <i class="icon-phone"></i>
                                            <a href="tel:{{ $getSystemSetting->phone_two }}">{{ $getSystemSetting->phone_two }}</a>
                                        </li>
                                    @endif

                                    @if(!empty($getSystemSettingApp->email))
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <a href="mailto:{{ $getSystemSetting->email }}">{{ $getSystemSetting->email }}</a>
                                        </li>
                                    @endif

                                    @if(!empty($getSystemSetting->email_two))
                                        <li>
                                            <i class="icon-envelope"></i>
                                            <a href="mailto:{{ $getSystemSetting->email_two }}">{{ $getSystemSetting->email_two }}</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-5">
                            <div class="contact-info">
                                <h3></h3>

                                <ul class="contact-list">
                                    @if(!empty($getSystemSetting->working_day))
                                        <li>

                                            <i class="icon-calendar"></i>
                                            <span class="text-dark">{{ $getSystemSetting->working_day }}</span>
                                            <br>
                                            {{ $getSystemSetting->working_hour }}
                                        </li>
                                    @endif
                                    {{-- <li>
                                       <i class="icon-clock-o"></i>
                                        <span class="text-dark">Sunday</span> <br>11am-6pm ET
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="title mb-1">Got Any Questions?</h2>
                    <p class="mb-2">Use the form below to get in touch with the sales team</p>
                    @include('layouts._message')
                    <form></form>
                    <form action="" class="contact-form mb-3" method="post">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cname" class="sr-only">Name</label>
                                <input type="text" class="form-control" name="name" id="cname" placeholder="Name *" required>
                            </div>

                            <div class="col-sm-6">
                                <label for="cemail" class="sr-only">Email</label>
                                <input type="email" class="form-control" name="email" id="cemail" placeholder="Email *" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <label for="cphone" class="sr-only">Phone</label>
                                <input type="tel" class="form-control" name="phone" id="cphone" placeholder="Phone">
                            </div>

                            <div class="col-sm-6">
                                <label for="csubject" class="sr-only">Subject</label>
                                <input type="text" class="form-control" name="subject" id="csubject" placeholder="Subject *" required>
                            </div>
                        </div>

                        <label for="cmessage" class="sr-only">Message</label>
                        <textarea class="form-control" cols="30" rows="4" name="message" id="cmessage" required placeholder="Message *" required></textarea>

                        <button type="submit" class="btn btn-outline-primary-2 btn-minwidth-sm">
                            <span>SUBMIT</span>
                            <i class="icon-long-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<hr class="mt-1 mb-1">
@endsection
