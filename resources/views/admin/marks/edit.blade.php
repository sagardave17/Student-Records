@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('quickadmin.marks.title')</h3>
    
    {!! Form::model($mark, ['method' => 'PUT', 'route' => ['admin.marks.update', $mark->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('quickadmin.qa_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('user_id', trans('quickadmin.marks.fields.user').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('user_id', $users, old('user_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('user_id'))
                        <p class="help-block">
                            {{ $errors->first('user_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('semester_id', trans('quickadmin.marks.fields.semester').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('semester_id', $semesters, old('semester_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('semester_id'))
                        <p class="help-block">
                            {{ $errors->first('semester_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('subject_id', trans('quickadmin.marks.fields.subject').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('subject_id', $subjects, old('subject_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Subject</p>
                    @if($errors->has('subject_id'))
                        <p class="help-block">
                            {{ $errors->first('subject_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('mark', trans('quickadmin.marks.fields.mark').'*', ['class' => 'control-label']) !!}
                    {!! Form::number('mark', old('mark'), ['class' => 'form-control', 'placeholder' => 'Mark', 'required' => '']) !!}
                    <p class="help-block">Mark</p>
                    @if($errors->has('mark'))
                        <p class="help-block">
                            {{ $errors->first('mark') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('quickadmin.qa_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

