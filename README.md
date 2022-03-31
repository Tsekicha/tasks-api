# PHP CRUD-API -
This is about Back-end API for creating tasks and assigning multiple tags to specific task.

## Author -
My name is Tsvetomir Kostov. I'm currently student and learning the depths of PHP, while i'm writing small projects for beginners/juniors. <br>
***I want to mention that i am still beginner at this point and project might have mistakes and errors which i'll fix if i find them***

## PREREQUISITES -
- PHP
- OOP
- MySQL
- POSTMAN ( Software for testing APIs )

## Getting started -
The project will perfom CRUD operation which stands for:
- C : create
- R : read
- U : update
- D : delete

I am using PHP for scripting, MySql ( phpmyadmin ) for database and Postman for testing. Postman is really easy and comfortably.

## Config -
 The database connection is in .config/db.php and the table information for creating and foreign keys are in dump.sql file.
 
 When you open the project folder, start the server with  *php -S localhost:8080* 
 
## API - 
./object folder contains the method for task and tags. <br>
./tasks and ./tags folder contains the logic for the CRUD operations.

## Examples -

**GET/tasks/read** - Get all the records from `task` table

**INPUT: http://localhost:8080/tasks/tasks_read.php**<br>
**JSON:**
```{
    "tasks": [
        {
            "id_task": "22",
            "task_name": "Buy tomatos",
            "tag_id": "13"
        },
        {
            "id_task": "22",
            "task_name": "Buy tomatos",
            "tag_id": "20"
        },
        {
            "id_task": "20",
            "task_name": "Buy milk",
            "tag_id": "14"
        },
        {
            "id_task": "20",
            "task_name": "Buy milk",
            "tag_id": "21"
        },
        {
            "id_task": "17",
            "task_name": "Buy chocolate",
            "tag_id": "13"
        },
        {
            "id_task": "17",
            "task_name": "Buy chocolate",
            "tag_id": "23"
        }
    ]
}
```
**GET/task/read/{id}** - Get the record by id in the `task` table

**INPUT: http://localhost:8080/tasks/task_readOne.php?id_task=17** <br>
**JSON:**
```
{
    "id_task": "17",
    "task_name": "Buy chocolate"
}
```
**POST/tasks/create** - Create records and insert them into `task` table

**INPUT: http://localhost:8080/tasks/create_post.php** <br>
**BODY:**
```
[
   {
       "task_name":"Buy banana",
       "tags": [13,16]
   },

   {
       "task_name": "Buy whiskey",
       "tags":[14]
   }
]
```
**POST/tasks/update** - Update records from `tasks` and `task_tag` tables
**INPUT: http://localhost:8080/tasks/update_post.php** <br>
**BODY:**
```
[
   {
        "id_task":"20",
        "task_name":"Buy milk",
        "tags": [14,21]
   },

   {
        "id_task":"17",
        "task_name":"Buy chocolate",
        "tags": [13,23]
   }
]
```
**POST/tasks/delete{id}** - Update records from `tasks` and `task_tag` tables
**INPUT: http://localhost:8080/tasks/delete_post.php** <br>
**BODY:**
```
[
    {
        "id_task": "21"
    },

    {
        "id_task": "19"
    }
]
```

The same CRUD operations goes for `tag` table.

## End point -
I hope I have been helpful and if there are any mistakes, get back to me

