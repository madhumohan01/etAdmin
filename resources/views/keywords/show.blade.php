@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Keyword
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="padding-left: 20px">
                    @include('keywords.show_fields')
                    <a href="{!! route('keywords.index') !!}" class="btn btn-default">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
