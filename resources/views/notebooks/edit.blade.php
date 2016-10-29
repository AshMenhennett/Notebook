@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your notebook</div>

                <div class="panel-body">
                    <form action="{{ route('notebooks.update', $notebook) }}" method="post">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Update notebook</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ $notebook->title }}">
                            @if ($errors->has('title'))
                                <div class="help-block">
                                    {{ $errors->first('title') }}
                                </div>
                            @endif
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default pull-right">Update</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
