<x-layout>
    <div class="row">
        <div class="col-md-2">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <form method="get" action="{{ route('tasks') }}">
                            <div class="input-group">
                                <div class="form-outline">
                                    <input type="search" name="q" class="form-control" value="{{ request()->input('q') }}" />
                                    <label class="form-label" for="form1">Search</label>
                                </div>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <hr>
                    <form method="get" action="{{ route('tasks') }}">
                        <div class="card-title">Filter</div>
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="done" 
                                    value="solved" @if (request()->input('done') == 'solved')
                                        checked
                                    @endif/>
                                <label class="form-check-label">Solved</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="done" 
                                    value="unsolved" @if (request()->input('done') == 'unsolved')
                                        checked
                                    @endif />
                                <label class="form-check-label">Unsolved</label>
                            </div>
                        </div>
                        <div class="card-title">Score</div>
                        <div class="card-body">
                            <select class="form-select" name="score_id">
                                <option value="">Select score</option>
                                @foreach ($scores as $score)
                                @if ($score->id == request()->input('score_id'))
                                <option value="{{ $score->id }}" selected>{{ $score->name }}</option>
                                @else
                                <option value="{{ $score->id }}">{{ $score->name }}</option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-filter"></i>
                            </button>
                            <a href="{{ route('tasks') }}" class="btn btn-blue">
                                <i class="fas fa-refresh"></i></a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="card">
                    <div class="card-title"><h3>Categories</h3></div>
                    <div class="card-body">
                        <div class="list-group list-group-light">
                            @foreach ($categories as $category)
                            @if ($category->id == request()->input('category_id'))
                            <a href="{{ route('tasks', array_merge(request()->all(), ['category_id' => $category->id])) }}" 
                                class="list-group-item list-group-item-action px-3 border-0 active" aria-current="true">{{ $category->title }}</a>
                            @else
                            <a href="{{ route('tasks', array_merge(request()->all(), ['category_id' => $category->id])) }}" 
                                class="list-group-item list-group-item-action px-3 border-0">{{ $category->title }}</a>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
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
                            <div class="card-header">
                                {{ $task->category->title }}
                                <cite title="{{ $task->score->name }}">
                                    <i class="fas fa-circle me-2 text-warning"></i>{{ $task->score->name }}
                                </cite>
                            </div>
                            <div class="card-body">
                                <h5 class="card-title">{{ $task->title }}</h5>
                                <p class="card-text">{{ $task->description }}</p>
                                <cite title="{{ $task->doneLabel() }}">
                                    @if ($task->done) 
                                    <span class="badge badge-success">{{ $task->doneLabel() }}</span>
                                    @else
                                    <span class="badge badge-primary">{{ $task->doneLabel() }}</span>
                                    @endif
                                </cite>
                            </div>
                            <div class="card-footer text-muted">
                                @php
                                    $classes = ['success', 'danger', 'warning', 'primary', 'info'];
                                @endphp
                                @foreach($task->tags as $tag)
                                <a href="#" class="btn btn-outline-{{ $classes[random_int(0, 4)] }} btn-sm" data-mdb-ripple-color="dark">{{ $tag->name }}</a>
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

            {!! $tasks->withQueryString()->links('pagination::bootstrap-5') !!}
        </div>
    </div>
</x-layout>