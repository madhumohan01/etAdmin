@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Unsubscribe List
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($unsubscribeList, ['route' => ['unsubscribeLists.update', $unsubscribeList->id], 'method' => 'patch']) !!}

                        @include('unsubscribe_lists.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection