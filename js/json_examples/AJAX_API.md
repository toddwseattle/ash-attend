# AJAX API for Ash-Attend

This folder contains the example/spec for the json api between front end and backend.

## Format

Each file gives a JSON example of what the request is likely to look like; and a plausible response example and structure.

the "request" key will be a post or a get (indicated here)

## AJAX API's

The application implements the following AJAX API's. links go to the action folder and each is represented by it's linked php file.

### [get_user](actions/get_user.php)

#### Purpose

get_user retrieves a user from the user table by their user_id.

#### GET

```json
{ "user_id": number }
```

#### Response

```json
{
  result: "success" | "failure",
  user : {
        user_id : number,
        user_fname : string,
        user_lname : string,
        user_gender : string,
        user_email : string,
        user_pass : string,
        user_role : number,
        user_status: number
  }
```

### [add_user_action](actions/add_user_action.php)

#### Purpose

add_user_action Adds a student to the system (only students) no password. requires user be a faculty or fi

#### POST

```json
{
  "f_name": "Todd",
  "l_name": "Warren",
  "email": "todd@warrenfamily.org",
  "gender": "Male"
}
```

#### Response

```json
{
  "data": "success" | "duplicate" | "failed"
}
```

### [get_marks_by_student (GET)](./get_marks_by_student.json)

This passes a student id, and retrieves all the classes that they have marks for; as well as a map of each possible mark_status.

Current format proposes a denormalized structure.

### [get_class_by_day (GET)](./get_class_by_day.json)
#### GET
````json
{
  class_date: SQL_DATE, i.e. "2020-09-14"
}
````json
#### response
classes: [
  class_id:"",
  class_name:"",
  class_date:
] 

error: string


### [get_all_classes (GET)](./get_all_classes.json)

this returns the entire attend_class table from the database

### [get_marks_by_class (GET)](./get_marks_by_class.json)

Retrieve all marks for a given class, including de-normalized student name and id.

### [add_classes_action](actions/add_classes_action.php)

#### Purpose

add_classes_action adds a set of classes at once
by an admin to the attend_class table

#### POST

An array of classes:

```json
new_classes: [
  {
    "class_name": string,
    "class_date": sql_date
  },
  {
    "class_name": string,
    "class_date": sql_date
  } // ...
]
```

#### Response

````json
 {"success" | "fail"}

### [login_action (POST)](./logon_action.json)

### [login_action](actions/login_action.php)

#### Purpose

login_action is called to start a session by email id. The email id will already have been sanitized and a valid ashesi email format.

#### POST

```json
{
  "email": "twarren@ashesi.edu.gh"
}
````

#### Response

```json
{
  "result": "success" | "pending" | "inactive",
  "url": string //url to redirect to
}
```
