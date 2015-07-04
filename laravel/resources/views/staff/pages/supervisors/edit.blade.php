@extends('staff.layouts.default')
@section('title')
Edit: {{ $student->user->full_name}}
@endsection
@section('content')
<div class="col-lg-6 col-md-6">
    @include('global.includes.show_errors')
    {!! Form::model($student, ['method' => 'PATCH', 'action' => array('StudentsController@update', 'student_id' => $student->id)]) !!}
    <fieldset>
        <div class="form-group">
            {!! Form::label('Title') !!}
            {!! Form::text('title', $student->user->title, ['class' => 'form-control', 'placeholder' => 'Mr']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('First name') !!}
            {!! Form::text('first_name', $student->user->first_name, ['class' => 'form-control', 'placeholder' => 'Jeffrey']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Middle name') !!}
            {!! Form::text('middle_name', $student->user->middle_name, ['class' => 'form-control', 'placeholder' => 'Lynn']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Last name') !!}
            {!! Form::text('last_name', $student->user->last_name, ['class' => 'form-control', 'placeholder' => 'Goldblum']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Enrolment number') !!}
            {!! Form::text('enrolment', null, ['class' => 'form-control', 'placeholder' => 'GOL12345678', 'maxlength' => '11', 'pattern' => '[A-Z]{3}[0-9]{8}']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Account email') !!}
            {!! Form::email('email', $student->user->email, ['class' => 'form-control', 'placeholder' => '12345678@students.lincoln.ac.uk']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Personal/other email') !!}
            {!! Form::email('personal_email', $student->user->personal_email, ['class' => 'form-control', 'placeholder' => 'ian.malcolm@jurassicsystems.com']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Phone number') !!}
            {!! Form::text('personal_phone', $student->user->personal_phone, ['class' => 'form-control', 'placeholder' => '07898765432']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Gender') !!}
            {!! Form::text('gender', null, ['class' => 'form-control', 'placeholder' => 'Male']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Home address') !!}
            {!! Form::textarea('home_address', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Current address') !!}
            {!! Form::textarea('current_address', null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Nationality') !!}
            {!! Form::text('nationality', null, ['class' => 'form-control', 'placeholder' => 'British']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Start date') !!}
            {!! Form::input('date', 'start', $student->start, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('End date') !!}
            {!! Form::input('date', 'end', $student->end, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('UKBA status') !!}
            {!! Form::select('ukba_status_id', $ukba_status, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Funding') !!}
            {!! Form::select('funding_type_id', $funding_types, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Award') !!}
            {!! Form::select('award_id', $awards, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Mode of Study') !!}
            {!! Form::select('mode_of_study_id', $modes_of_study, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('Enrolment Status') !!}
            {!! Form::select('enrolment_status_id', $enrolment_statuses, null, ['class' => 'form-control']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('Disable student login') !!}
            {!! Form::checkbox('locked', '1', $student->user->locked) !!}
        </div>
        <div class="btn-group">
            <a class="btn btn-default" href="{{ action('StudentsController@show', ['enrolment' => $student->enrolment]) }}">Cancel</a>
        </div>
        <div class="btn-group">
            {!! Form::submit('Update student', ['class' => 'btn btn-primary form-control']) !!}
        </div>
    </fieldset>
    {!! Form::close() !!}
</div>
@endsection
@stop