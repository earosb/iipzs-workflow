<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">{{ $title }}</div>

        <div class="panel-body">
            @include('flash::message')
            {{ $slot }}
        </div>
    </div>
</div>