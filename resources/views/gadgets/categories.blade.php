<!-- Categories Widget -->
@if($data)
<div class="card">
  <h5 class="card-header">Categories</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-inline">
            @foreach($data as $item)
              @if($loop->iteration  % 2 == 0)
                <li class="item d-flex">
                    <a href="{{ route('blog.category', $item->id) }}">{{ $item->name }}</a> <span>({{ $item->posts_count }})</span>
                </li>
              @endif 
            @endforeach
          </ul>
        </div>

        <div class="col-lg-6">
          <ul class="list-inline">
            @foreach($data as $item)
              @if($loop->iteration  % 2 != 0)
                <li class="item d-flex">
                    <a href="{{ route('blog.category', $item->id) }}">{{ $item->name }}</a> <span>({{ $item->posts_count }})</span>
                </li>
              @endif 
            @endforeach
          </ul>
        </div>
      </div>
    </div>
  </div>
@endif
