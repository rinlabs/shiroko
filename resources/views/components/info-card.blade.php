<div class="card">
    <div class="card-body text-center">
        <div class="row">
            <h4>
               {{$value}}
                @if(isset($append))
                    <small class="text-muted">{{$append}}</small>
                @endif
            </h4>
            <p>{{$title}}</p>
        </div>
    </div>
</div>
