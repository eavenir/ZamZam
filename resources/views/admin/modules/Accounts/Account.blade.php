@extends('admin/layouts/mainlayout')
@section('content')

<div class="content-wrapper">
    <section class="content-header">
        <h1>Bank</h1>
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">

                @if (session('status'))
                <h6 class="alert alert-success">{{ session('status') }}</h6>
                @endif

                <div class="box box-default">

                    <div class="box-body">

                        @include('admin/modules/Accounts/Account_html')

                    </div>
                </div>

            </div>
        </div>

    </section>

</div>

@include('admin/modules/Accounts/Accountjs')
@endsection