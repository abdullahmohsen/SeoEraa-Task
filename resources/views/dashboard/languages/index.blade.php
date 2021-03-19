@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.languages')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li class="active">@lang('site.languages')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header with-border">

                    <h3 class="box-title" style="margin-bottom: 15px">@lang('site.languages') <small>{{ $languages->count() }}</small></h3>

                    <form action="{{ route('languages.index') }}" method="get">

                        <div class="row">

                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')" value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> @lang('site.search')</button>
                                <a href="{{ route('languages.create') }}" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.add')</a>
                            </div>

                        </div>
                    </form><!-- end of form -->

                </div><!-- end of box header -->

                <div class="box-body">

                    @if (count($languages))
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>@lang('site.title')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.slogan')</th>
                                <th>@lang('site.direction')</th>
                                <th>@lang('site.active')</th>
                                <th>@lang('site.action')</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach ($languages as $index=>$language)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $language->title }}</td>
                                    @if ($language->image)
                                        <td><img src="{{ $language->image_path }}" style="width: 100px"  class="img-thumbnail" alt=""></td>
                                    @else
                                        <td>@lang('site.no_image')</td>
                                    @endif
                                    <td>{{ $language->slogan }}</td>
                                    <td>{{ $language->direction }}</td>
                                    <td>{{ $language->getActive() }}</td>
                                    <td>
                                        <a href="{{ route('languages.edit', $language->id) }}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i> @lang('site.edit')</a>
                                        <form action="{{ route('languages.delete', $language->id) }}" method="post" style="display: inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-danger delete btn-sm"><i class="fa fa-trash"></i> @lang('site.delete')</button>
                                        </form><!-- end of form -->
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>

                        </table><!-- end of table -->

                    @else

                        <h2>@lang('site.no_languages_found')</h2>

                    @endif

                </div><!-- end of box body -->


            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->


@endsection
