# AJAX API for Ash-Attend

This folder contains the example/spec for the json api between front end and backend.

## Format

Each file gives a JSON example of what the request is likely to look like; and a plausible response example and structure.

Each API indicates whether it is an HTTP POST or an HTTP GET

## AJAX API's

The application implements the following AJAX API's. links go to the action folder and each is represented by it's linked php file.

### [get_user](/actions/get_user.php)

#### Purpose

get_user retrieves a user from the user table by their user_id.

#### GET

```js
{ "user_id": id }
```

#### Response

```js
{
  result: "success" | "failure",
  user : {
        user_id : id,
        user_fname : "string",
        user_lname : "string",
        user_gender : "string",
        user_email : "string",
        user_pass : "string",
        user_role : 1 | 2| 3, //  faculty, fi, student respectively
        user_status: "success" | "pending" | "inactive" // 1,2,3
  }
```

### [add_user_action](/actions/add_user_action.php)

#### Purpose

add_user_action Adds a student to the system (only students) no password. requires user be a faculty or fi

#### POST

```js
{
  "f_name": "Todd",
  "l_name": "Warren",
  "email": "todd@warrenfamily.org",
  "gender": "Male"
}
```

#### Response

```js
{
  "data": "success" | "duplicate" | "failed"
}
```

### [get_marks_by_student (GET)](#)
[Sample JSON](./get_marks_by_student.json)

This passes a student id, and retrieves all the classes that they have marks for; as well as a map of each possible mark_status.

Current format proposes a de-normalized structure.

### [get_class_by_day (GET)]()
[Sample JSON](./get_class_by_day.json)
#### GET
```js
{
  class_date: SQL_DATE, i.e. "2020-09-14"
}
```

#### response
```js
classes: [
  class_id:"",
  class_name:"",
  class_date:
] 

error: "string"
```

### [get_all_classes (GET)](#)
[Sample JSON](./get_all_classes.json)

this returns the entire attend_class table from the database

### [get_marks_by_class (GET)](#)
[Sample JSON](./get_marks_by_class.json)

Retrieve all marks for a given class, including de-normalized student name and id.

### [mark_attendance_action (Post)](/actions/mark_attendance_action.php)

#### Purpose
Marks attendance.  can only be activated by student on a current class.  creates something in the mar

##### POST
```js
{
  class_id:
  user_id:
  status: 0| 1 | 2 | 3 // absent, present, late, pending respectively
}
```

##### response
"success" | "fail"



### [add_classes_action (POST)](/actions/add_classes_action.php)



[Sample JSON](./add_classes_action.json)
#### Purpose

add_classes_action adds a set of classes at once
by an admin to the attend_class table

#### POST

An array of classes:

```js
new_classes: [
  {
    "class_name": "string",
    "class_date": sql_date
  },
  {
    "class_name": "string",
    "class_date": sql_date
  } // ...
]
```

#### Response

```js
 {"success" | "fail"}
```
### [login_action](/actions/login_action.php)

[Sample JSON](./logon_action.json)
#### Purpose

login_action is called to start a session by email id. The email id will already have been sanitized and a valid ashesi email format.

#### POST

```js
{
  "email": "twarren@ashesi.edu.gh"
}
```

#### Response

```js
{
  "result": "success" | "pending" | "inactive",
  "url": "string" //url to redirect to
}
```
