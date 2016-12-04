@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Edit your note</div>

                <div class="panel-body">
                    <form action="{{ route('note.update', [$notebook, $note]) }}" method="post">
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content">Update note</label>
                            <input type="text" class="form-control" id="content" name="content" value="{{ $note->content }}">
                            @if ($errors->has('content'))
                                <div class="help-block">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default pull-right">Update</button>
                        <a href="{{ route('notebook.show', $notebook) }}" class="btn btn-default pull-right">Cancel</a>
                    </form>
                </div>

            </div>
        </div>
    </div>

</div>
@endsection
