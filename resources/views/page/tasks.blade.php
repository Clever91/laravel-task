<x-layout>

    <x-slot:title>
        Custom Title
    </x-slot>
    
    <div class="row">
        <div class="col-md-2">
            One of three columns
        </div>
        <div class="col-md-10">
            @php
                $counter = 0
            @endphp
            @foreach ($tasks as $task)
                @if ($counter % 3 == 0)
                <div class="row">
                @endif
                @php
                    $counter++
                @endphp
                    <div class="col-md-4 col-sm-4">
                        <!-- Card -->
                        <div class="card">
                            <div class="card-header">{{ $task->category->title }}</div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
                                    content.</p>
                            </div>
                            <div class="card-footer text-muted">
                                @foreach($task->tags as $index => $tag)
                                <a href="#!" class="btn btn-outline-success btn-sm" data-mdb-ripple-color="dark">{{ $tag->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <!-- Card -->
                    </div>
                @if ($counter % 3 == 0)
                </div>
                <hr>
                @endif
            @endforeach
        </div>
    </div>
</x-layout>