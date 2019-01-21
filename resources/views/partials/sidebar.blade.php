@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">



            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('quickadmin.qa_dashboard')</span>
                </a>
            </li>

            @can('degree_access')
            <li>
                <a href="{{ route('admin.degrees.index') }}">
                    <i class="fa fa-align-justify"></i>
                    <span>@lang('quickadmin.degree.title')</span>
                </a>
            </li>@endcan

           @can('user_access')
            <li>
                <a href="{{ route('admin.users.index') }}">
                    <i class="fa fa-user"></i>
                    <span>@lang('quickadmin.users.title')</span>
                </a>
            </li>@endcan

            @can('semester_access')
            <li>
                <a href="{{ route('admin.semesters.index') }}">
                    <i class="fa fa-align-justify"></i>
                    <span>@lang('quickadmin.semester.title')</span>
                </a>
            </li>@endcan

            @can('subject_access')
            <li>
                <a href="{{ route('admin.subjects.index') }}">
                    <i class="fa fa-align-justify"></i>
                    <span>@lang('quickadmin.subjects.title')</span>
                </a>
            </li>@endcan

            @can('mark_access')
            <li>
                <a href="{{ route('admin.marks.index') }}">
                    <i class="fa fa-align-justify"></i>
                    <span>@lang('quickadmin.marks.title')</span>
                </a>
            </li>@endcan

            @can('user_details')
            <li>
                <a href="{{ route('admin.users.show', ['id' => \Auth::user()->id]) }}">
                    <i class="fa fa-align-justify"></i>
                    <span>@lang('quickadmin.users.my-details')</span>
                </a>
            </li>@endcan

            @can('data')
            <li>
                <a href="{{ route('admin.users.show-data') }}">
                    <i class="fa fa-align-justify"></i>
                    <span>@lang('quickadmin.users.data')</span>
                </a>
            </li>@endcan

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('quickadmin.qa_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('quickadmin.qa_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

