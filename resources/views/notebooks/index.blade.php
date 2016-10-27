@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form action="{{ route('notebooks.create') }}" method="post">
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title">Create a new Notebook</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Name your new notebook">
                            @if ($errors->has('title'))
                                <div class="help-block">{{ $errors->first('title') }}</div>
                            @endif
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default pull-right">Create</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your Notebooks</div>

                <div class="panel-body">
                    @if (count($notebooks))
                        <ul class="list-group">
                            @foreach ($notebooks as $notebook)
                                <li class="list-group-item">
                                    <a href="{{ route('notebooks.show', $notebook) }}" class="pull-left">{{ $notebook->title }}</a>

                                    <form action="{{ route('notebooks.destroy', $notebook) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                                    </form>

                                    <a href="{{ route('notebooks.edit', $notebook) }}" class="btn btn-info btn-xs pull-right"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>You currently don't have any notebooks saved.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
