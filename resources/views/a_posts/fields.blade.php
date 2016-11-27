<!-- Place Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('place_id', 'Place Id:') !!}
    {!! Form::number('place_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Section Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('section_id', 'Section Id:') !!}
    {!! Form::number('section_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Post Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_id', 'Post Id:') !!}
    {!! Form::text('post_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Post Date Field -->
<div class="form-group col-sm-6">
    {!! Form::label('post_date', 'Post Date:') !!}
    {!! Form::date('post_date', null, ['class' => 'form-control']) !!}
</div>

<!-- Heading Field -->
<div class="form-group col-sm-6">
    {!! Form::label('heading', 'Heading:') !!}
    {!! Form::text('heading', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Job Link Field -->
<div class="form-group col-sm-6">
    {!! Form::label('job_link', 'Job Link:') !!}
    {!! Form::text('job_link', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Addr Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_addr', 'Email Addr:') !!}
    {!! Form::text('email_addr', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email_id', 'Email Id:') !!}
    {!! Form::number('email_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Bad Action Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bad_action', 'Bad Action:') !!}
    {!! Form::text('bad_action', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('aPosts.index') !!}" class="btn btn-default">Cancel</a>
</div>
