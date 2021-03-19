@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.admins')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.admins')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.admins') <small>{{ $admins->count() }}</small></h3>

                    <form action="{{ route('admins.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                @if (auth()->user()->hasPermission('users-create'))
                                    <a href="{{ route('admins.create') }}" class="btn btn-primary"><i class="fa fa-user-plus"></i> @lang('site.add')</a>
                                @else
                                    <button href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i> @lang('site.add')</button>
                                @endif
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if (count($admins))

                        <table class="table table-hover">

                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.name')</th>
                                <th>@lang('site.email')</th>
                                <th>@lang('site.status')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($admins as $index=>$admin)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $admin->name }}</td>
                                    <td>{{ $admin->email }}</td>
{{--                                    <td>{{ $admin->getActive() }}</td>--}}
                                    <td>
                                        @if ($admin->is_activated == 1)
                                            <span style="font-size: 13px;"
                                                  class="label label-primary">{{ $admin->getActive() }}</span>
                                        @else
                                            <span style="font-size: 13px;"
                                                  class="label label-warning">{{ $admin->getActive() }}</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if (auth()->user()->hasPermission('users-update'))
                                            <a href="{{ route('admins.edit', $admin->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        @else
                                            <button class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i> @lang('site.edit')</button>
                                        @endif

                                        @if (auth()->user()->hasPermission('users-delete'))
                                            <form action="{{ route('admins.delete', $admin->id) }}" method="post" style="display: inline-block">
                                                @csrf
                                                <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                            </form><!-- end of form -->
                                        @else
                                            <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table><!-- end of table -->
                    @else
                        <h2>@lang('site.no_data_found')</h2>
                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
