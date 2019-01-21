<table class="table table-bordered table-striped {{ count($marks) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('quickadmin.marks.fields.user')</th>
            <th>@lang('quickadmin.marks.fields.semester')</th>
            <th>@lang('quickadmin.marks.fields.subject')</th>
            <th>@lang('quickadmin.marks.fields.mark')</th>
        </tr>
    </thead>

<tbody>
    @if (count($marks) > 0)
        @foreach ($marks as $mark)
            <tr data-entry-id="{{ $mark->id }}">
                <td field-key='user'>{{ $mark->user->name ?? '' }}</td>
                    <td field-key='semester'>{{ $mark->semester->name ?? '' }}</td>
                    <td field-key='subject'>{{ $mark->subject->name ?? '' }}</td>
                    <td field-key='mark'>{{ $mark->mark }}</td>
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="4">@lang('quickadmin.qa_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>