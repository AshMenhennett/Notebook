@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">

                <div class="panel-body">
                    <form action="{{ route('note.create', $notebook) }}" method="post">
                        <div class="form-group{{ $errors->has('content') ? ' has-error' : '' }}">
                            <label for="content">Add a Note</label>
                            <input type="text" class="form-control" id="content" name="content" placeholder="Add a note">
                            @if ($errors->has('content'))
                                <div class="help-block">
                                    {{ $errors->first('content') }}
                                </div>
                            @endif
                        </div>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-default pull-right">Add</button>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Your {{ $notebook->title }} Notebook</div>

                <div class="panel-body">
                    @if (count($notes))
                        <ul class="list-group">
                            @foreach ($notes as $note)
                                <li class="list-group-item">
                                    <p class="pull-left">{{ $note->content }}</p>
                                    <form action="{{ route('note.destroy', [$notebook, $note]) }}" method="post">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-xs pull-right"><span class="glyphicon glyphicon-remove"></span> Delete</button>
                                    </form>
                                    <a href="{{ route('note.edit', [$notebook->uid, $note->uid]) }}" class="btn btn-xs btn-info pull-right"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
                                </li>
                            @endforeach
                        </ul>
                    @else
                        <p>You currently don't have any notes saved in this Notebook.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
