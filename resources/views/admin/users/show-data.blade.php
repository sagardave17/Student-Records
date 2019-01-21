@extends('layouts.app')

@section('content')
    <h3 class="page-title">My Data</h3>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('semester_id', trans('quickadmin.subjects.fields.semester').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('semester_id', $semesters, old('semester_id'), ['class' => 'form-control select2', 'required' => 'required', 'placeholder' => 'Select', 'id' => 'semester_id']) !!}
                </div>
            </div>
        </div>

<!-- Tab panes -->
<div class="tab-content">
    <div role="tabpanel" class="tab-pane active" id="marks">
        @include('admin.users.list')
    </div>
</div>

</div>
@stop
@section('after-javascript')
<script>
        // console.log('sagar');
    $('#semester_id').change(function(e) {
        e.preventDefault();
        var selectedValue = $(this).val();
            console.log(selectedValue);
        if(selectedValue) {
            $.ajax({
                url : "{{ route('admin.users.get-data') }}",
                data : {id : selectedValue},
            }).done(function (data) {
                $('#marks').html(data);
            }).fail(function () {
                alert('No Data Found.');
            });
        }
    });
</script>
@stop


