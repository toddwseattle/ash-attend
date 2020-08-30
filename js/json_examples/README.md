# JSON Api Examples

This folder contains the example/spec for the json api between front end and backend

## Format

Each file gives a JSON example of what the request is likely to look like; and a plausible response example and structure.

the "request" key will be a post or a get (indicated here)

## Api's

### [add_user_action (POST)](./add_user_action.json)

This adds a user to the system.

### [get_marks_by_student (GET)](./get_marks_by_student.json)

This passes a student id, and retrieves all the classes that they have marks for; as well as a map of each possible mark_status.

Current format proposes a denormalized structure.

### [get_closest_class (GET)](./get_closest_class.json)

This passes a date (What format?) and then it returns the class id closest in time to date. It will be used in the "mark current attendance" It should be any class within 24 hours prior of the requested date.

### [get_all_classes (GET)](./get_all_classes.json)

this returns the entire attend_class table from the database

### [get_marks_by_class (GET)](./get_marks_by_class.json)

Retrieve all marks for a given class, including de-normalized student name and id.

### add_classes (POST)

an admin function to add classes to attend_class table

### [login_action (POST)](./logon_action.json)
