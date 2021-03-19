@extends('layouts.dashboard.app')

@section('content')

    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('site.languages')</h1>

            <ol class="breadcrumb">
                <li><a href="{{ route('home') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a></li>
                <li><a href="{{ route('languages.index') }}"> @lang('site.languages')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>

        <section class="content">

            <div class="box box-primary">

                <div class="box-header">
                    <h3 class="box-title">@lang('site.edit')</h3>
                </div><!-- end of box header -->
                <div class="box-body">

                    @include('partials._errors')

                    <form action="{{ route('languages.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" class="form-control" value="{{ $language->id }}">

                        <div class="form-group">
                            <label>@lang('site.title')</label>
                            <input type="text" name="title" class="form-control" value="{{ $language->title }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.slogan')</label>
                            <input type="text" name="slogan" class="form-control" value="{{ $language->slogan }}">
                        </div>

                        <div class="form-group">
                            <label>@lang('site.direction')</label>
                            <select name="direction" class="form-control">
                                <optgroup label="@lang('site.please.choose.the.direction')">
                                    <option value="rtl" @if($language->direction == 'rtl' ) selected @endif>@lang('site.from.right.to.left')</option>
                                    <option value="ltr" @if($language ->direction == 'ltr') selected @endif>@lang('site.from.left.to.right')</option>
                                </optgroup>
                            </select>
                        </div>

                        <div class="form-group">
                            <label class="mr-2">
                                <input type="checkbox" name="active" @if($language->active == 1) checked @endif value="1">
                                @lang('site.activate')</label>
                        </div>

                        <div class="form-group">
                            <label>@lang('site.image')</label>
                            <input type="file" name="image" class="form-control image">
                        </div>

                        @if ($language->image)
                            <div class="form-group">
                                <img src="{{ $language->image_path }}" style="width: 100px" class="img-thumbnail image-preview" alt="">
                            </div>
                        @endif

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i> @lang('site.edit')</button>
                        </div>

                    </form><!-- end of form -->

                </div><!-- end of box body -->

            </div><!-- end of box -->

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->

@endsection
