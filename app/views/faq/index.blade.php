@section('content')
    <div class="jumbotron text-center startpage">
        <h1>Frequently Asked Questions</h1>
        <p>Här hittar du svaren på vanliga frågor som ställs... Klicka på en fråga du vill ha svar på.</p>
    </div>

    <div class="row">

    @foreach ($faqs as $faq)
    <div class="col-md-12">
      <div class="panel-group" id="accordion">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h4 class="panel-title">
              <a data-toggle="collapse" data-parent="#accordion" href="#collapse-{{ $faq->id }}">
                {{ $faq->question }}
              </a>
            </h4>
          </div>
          <div id="collapse-{{ $faq->id }}" class="panel-collapse collapse">
            <div class="panel-body" style="color: #000;">
              <p class="lead">{{ $faq->question }}</p>
              {{ nl2br($faq->answer) }}
            </div>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>

@stop