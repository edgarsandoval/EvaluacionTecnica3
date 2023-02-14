<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller {
    public function index(Request $request) {
        $recordsTotal = Task::count();
        $recordsFiltered = 0;
        $params = $request->all();
        if(count($params) == 0) {
            // no params show whole information
            $tasks = Task::all();
            $recordsFiltered = count($tasks);
        } else {
            $length     = $request->has('per_page') ? $request->input('per_page') : 10;
            $start      = $request->has('page') ? ($request->input('page') - 1) * $length : 0;
            $search     = $request->input('search');
            $params['per_page'] = $length;
            $params['page'] = $request->has('page') ? $request->input('page') : 1;

            if(isset($search)) {
                $params['search'] = $search;
                $tasks = Task::where('title', 'LIKE', '%' . $search . '%')
                        // ->skip($start)
                        // ->take($length)
                        ->get();
                $recordsTotal = count($tasks);
            } else if($request->has('user_id')) {
                $recordsTotal = Task::where('userId', $params['user_id'])->count();
                $params['user_id'] = $request->input('user_id');
                $tasks = Task::where('userId', $params['user_id'])
                            ->get();
            } else if($request->has('completed')) {
                $params['completed'] = $request->input('completed');
                $tasks = Task::where('completed', $params['completed'])
                            ->get();
                $recordsTotal = count($tasks);
            }else {
                $tasks = Task::skip($start)
                        ->take($length)
                        ->get();
            }

            $recordsFiltered = count($tasks);

            $params['total_pages'] = ceil($recordsTotal / $length);
        }


        return view('tasks', compact('tasks', 'recordsTotal', 'recordsFiltered', 'params'));
    }
}
