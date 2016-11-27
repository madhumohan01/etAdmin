@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            A Posts
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($aPosts, ['route' => ['aPosts.update', $aPosts->id], 'method' => 'patch']) !!}

                        @include('a_posts.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection