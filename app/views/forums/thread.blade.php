@section('content')

<div class="row">
    <div class="col-xs-12">
        <a class="btn btn-danger" href="{{ url('forum') }}">Gå tillbaka</a>
    </div>
    <div class="col-xs-12">
        <div class="row">
            <div class="col-xs-12">
                <div class="post-first">
                    <header>
                        <div class="title">
                            <h3>Tråd: {{ e($thread->title) }}, <i>{{ relativeTime(strtotime($thread->created_at)) }}</i></h3>
                        </div>
                    </header>
                    <div class="information">
                        <div class="row">
                            <div class="col-xs-3 post-user">
                                <h3>
                                    <a href="/anvandare/{{$thread->user->id}}">{{ $thread->user->username }}</a>
                                </h3>
                                <p>
                                    <span class="label label-success">
                                        Level: {{ $thread->user->level }}
                                    </span>
                                </p>
                            </div>
                            <div class="col-xs-9">
                                <p>{{ nl2br(e($thread->content)) }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @foreach ($thread->posts()->get() as $post)
    <div class="answer">
        <div class="col-xs-12">
            <div class="row">
                <div class="col-xs-12">
                    <div class="post">
                        <div class="information">
                            <div class="row">
                                <div class="col-xs-3 post-user">
                                    <h3>
                                        <a href="/anvandare/{{$post->user->id}}">{{ $post->user->username }}</a>
                                    </h3>
                                    <p>
                                        <span class="label label-success">
                                            Level: {{ $post->user->level }}
                                        </span>
                                    </p>
                                </div>
                                <div class="col-xs-9">
                                    <p>{{ nl2br(e($post->content)) }}</p>
                                </div>
                                <div class="col-xs-12">
                                    <div class="pull-right">
                                        <span class="label label-info">
                                            <i>{{ relativeTime(strtotime($post->created_at)) }}</i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach

    <div class="col-xs-12" style="margin-top: 30px">
        <div class="row">
            <div class="col-xs-12">
                <div class="thread">
                    <header>
                        <div class="title">
                            <h3>Svara</h3>
                        </div>
                    </header>
                    <div class="information">
                        <div class="row">
                            <div class="col-xs-12">
                                <form role="form" action="{{ action('PostController@reply') }}" method="post">
                                    <input type="hidden" name="thread_id" value="{{ $thread->id }}">

                                    {{ Form::token() }}

                                    <div class="form-group">
                                        <label for="content">Inlägg</label>
                                        <textarea class="form-control" name="content" rows="3"></textarea>
                                    </div>

                                    <input class="btn btn-lg btn-success btn-block" type="submit" value="Svara">        
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop