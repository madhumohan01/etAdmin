<!-- Tech Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tech_name', 'Tech Name:') !!}
    {!! Form::text('tech_name', null, ['class' => 'form-control']) !!}
</div>

<!-- Tech Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tech_type', 'Tech Type:') !!}
    {!! Form::text('tech_type', null, ['class' => 'form-control']) !!}
</div>

<!-- Tech Text 1 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tech_text_1', 'Tech Text 1:') !!}
    {!! Form::text('tech_text_1', null, ['class' => 'form-control']) !!}
</div>

<!-- Tech Text 2 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tech_text_2', 'Tech Text 2:') !!}
    {!! Form::text('tech_text_2', null, ['class' => 'form-control']) !!}
</div>

<!-- Tech Text 3 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tech_text_3', 'Tech Text 3:') !!}
    {!! Form::text('tech_text_3', null, ['class' => 'form-control']) !!}
</div>

<!-- Tech Text 4 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tech_text_4', 'Tech Text 4:') !!}
    {!! Form::text('tech_text_4', null, ['class' => 'form-control']) !!}
</div>

<!-- Tech Text 5 Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tech_text_5', 'Tech Text 5:') !!}
    {!! Form::text('tech_text_5', null, ['class' => 'form-control']) !!}
</div>

<!-- Seq No Field -->
<div class="form-group col-sm-6">
    {!! Form::label('seq_no', 'Seq No:') !!}
    {!! Form::number('seq_no', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('keywords.index') !!}" class="btn btn-default">Cancel</a>
</div>
