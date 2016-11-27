@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            A Email
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($aEmail, ['route' => ['aEmails.update', $aEmail->id], 'method' => 'patch']) !!}

                        @include('a_emails.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection