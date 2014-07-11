@section('content')
    <div class="jumbotron text-center startpage">
        <h1>Forum</h1>
        <p>Det här är ett allmänt forum där du kan diskutera buggar, be om hjälp, rekrytera spelare till din klubb, eller kanske hitta en klubb du kan vara intresserad av? Givetvis är saker som inte rör BaxaCykel.se tillåtet att diskutera om!</p>
    </div>
    @foreach ($categories as $category)
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3>{{ $category->title }}</h3>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped table-responsive table-hover">
                <thead>
                    <tr>
                        <th>Tråd</th>
                        <th>Av</th>
                        <th>När</th>
                        <th>Senast</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category->threads()->orderBy('last_post', 'DESC')->orderBy('updated_at', 'DESC')->limit(10)->get() as $thread)
                        <tr>
                            <td>
                                <a href="{{ url('trad/' . $thread->id) }}">{{ $thread->title }}
                            </td>
                            <td>
                                {{ $thread->user->username }}
                            </td>
                            <td>
                                {{ relativeTime(strtotime($thread->created_at)) }}
                            </td>
                            <td>
                                {{ relativeTime(strtotime($thread->last_post)) }}
                            </td>
                        </tr>
                    @endforeach
                 </tbody>
            </table>
        </div>
    </div>
    @endforeach

    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                <h3>Skapa tråd</h3>
            </div>
        </div>
        <div class="panel-body">
            <form role="form" action="{{ action('ThreadController@postThread') }}" method="post">

                {{ Form::token() }}

                <div class="form-group">
                    <label for="title">Rubrik</label>
                    <input type="text" name="title" value="{{ Input::old('title') }}" class="form-control">
                </div>

                <div class="form-group">
                    {{-- <label for="title">Kategori</label> --}}
                    <input type="hidden" name="category_id" value="1">
                    {{-- 
                    <select name="category_id" class="form-control">
                        @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                        @endforeach
                    </select>
                    --}}
                </div>

                <div class="form-group">
                    <label for="content">Inlägg</label>
                    <textarea class="form-control" name="content" rows="3">{{ Input::old('content') }}</textarea>
                </div>

                <input class="btn btn-lg btn-success btn-block" type="submit" value="Skapa tråd">        
            </form>
        </div>
    </div>
</div>
@stop