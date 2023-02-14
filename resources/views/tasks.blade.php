<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Task app</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
        <style media="screen">
            .container {
                text-align: center;
                margin-top: 15px;
            }

            #controls select {
                width: 50px;
                display: inline;
            }

            table tfoot,
            table tfoot *:not(a) {
                border: none !important;
                justify-content: end;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>List of task</h1>
            @if ($recordsTotal != $recordsFiltered && !isset($params['search']) && !isset($params['user_id']) && !isset($params['completed']))
                <h2>Showing from {!! ($params['page'] * $recordsFiltered) - $recordsFiltered + 1 !!} to {!! $params['page'] * $recordsFiltered !!} of {!! $recordsTotal !!} records</h2>
            @else
                <h2>Showing {!! $recordsTotal !!} records</h2>
                @if (isset($params['search']))
                    <h3>Containing word "{{ $params['search'] }}"</h3>
                @endif
            @endif
            @if ($recordsTotal == $recordsFiltered)
                @if (!isset($params['search']) && !isset($params['user_id']) && !isset($params['completed']))
                    <a href="/tasks?page=1" class="btn btn-primary">Show pagination</a>
                @endif
            @else
                <form id="controls" method="GET" action="/tasks">
                    @if (isset($params['user_id']))
                        <input type="hidden" name="user_id" value="{{ $params['user_id'] }}">
                    @endif
                    <div class="row">
                        <div class="col-md-3">
                            Show
                            <select class="form-control" name="per_page" id="page">
                                @foreach ([10, 15, 20, 25, 100, 200] as $per_page)
                                    <option value="{{ $per_page }}" {{ $params['per_page'] == $per_page ? 'selected' : '' }}>{{ $per_page }}</option>
                                @endforeach
                            </select>
                            records
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </form>
            @endif
            <hr/>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>USER ID</th>
                        <th>TITLE</th>
                        <th>COMPLETED</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->userId }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->completed ? 'YES' : 'NO' }}</td>
                    </tr>
                    @endforeach
                </tbody>
                @if (count($params) > 0 && !isset($params['search']) && !isset($params['user_id']) && !isset($params['completed']))
                    <tfoot>
                        <tr>
                            <td colspan="4">
                                <nav>
                                    <ul class="pagination">
                                        @for ($i = 1; $i <= $params['total_pages']; $i++)
                                            @if ($i == $params['page'])
                                                <li class="page-item active">
                                                    <a class="page-link" href="?page={{ $i }}&per_page={{ $params['per_page'] }}">{{ $i }} <span class="sr-only"></span></a>
                                                </li>
                                            @else
                                                <li class="page-item"><a class="page-link" href="?page={{ $i }}&per_page={{ $params['per_page'] }}">{{ $i }}</a></li>
                                            @endif
                                        @endfor
                                    </ul>
                                </nav>
                            </td>
                        </tr>
                    </tfoot>
                @endif
            </table>
        </div>
        <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#page').change(function() {
                $('#controls').submit();
            });
        });
        </script>
    </body>
</html>
