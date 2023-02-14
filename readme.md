# EvaluacionTecnica2

This project was built in Laravel

## Explanation

Application that shows a simple table of task retrieved form this endpoint: https://jsonplaceholder.typicode.com/todos
The application works only with one route, in addition if query params are sent the page render a different view.

/tasks - Shows all records
/tasks?page=1&per_page=10 - Shows first page that contains only 10 items, both [page] and [per_page] are variables
/tasks?search=ipsum - Should return results that contain the word “ipsum”, param [search] is variable
/tasks?user_id=3 - Should return all records for the selected user, param [user_id] is variable
/tasks?completed=false - Should return unfinished tasks, param [completed] must be true o false

## DEMO

https://et3.edgarsandoval.mx/tasks
