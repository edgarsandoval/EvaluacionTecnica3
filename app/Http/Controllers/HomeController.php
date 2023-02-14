<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Task;

class HomeController extends Controller {
    public function test() {
        try {
            $db = null !== DB::connection()->getPdo();
            return response()->json(compact('db'));
        } catch (\Exception $e) {
            die("Could not connect to the database.  Please check your configuration. error:" . $e );
        }
    }

    public function load() {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://jsonplaceholder.typicode.com/todos');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        $response = json_decode(curl_exec($ch), true);
        curl_close($ch);

        $imports = 0;
        foreach ($response as $data) {
            $task = new Task($data);
            $task->save();
            $imports++;
        }

        return response()->json(['msg' => sprintf('(%s) tasks imported', $imported), 'status' => true]);
    }
}
