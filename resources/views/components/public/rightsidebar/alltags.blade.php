        <div class="col-md-2">
        <div class="col-md-12">
        	Related Tags
        	<hr>
        </div>
            @foreach($tags as $tag)
                <a href="{{ route('public.events.tag', ['tag' => $tag->name]) }}">
                    <span class="label label-success">{{ $tag->name }}</span>
                </a>
            @endforeach
        </div>