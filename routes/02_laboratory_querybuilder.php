<?php


use Illuminate\Support\Facades\DB;

        // Task#1 Retrieve all students.
        // SQL Syntax: SELECT * FROM student
        $students = DB::table('students')->get();


        // Task#2 Retrieve students in a specific grade.
        // SQL Syntax: SELECT * FROM students WHERE grade = '10';
        $students = DB::table('students')->where('grade', '10')->get();


        // Task#3 Retrieve students with a specific age range.
        // SQL Syntax: SELECT * FROM students WHERE age BETWEEN 15 AND 18;
        $students = DB::table('students')->whereBetween('age', [15, 18])->get();


        // Task#4  Retrieve students from a specific city.
        // SQL Syntax: SELECT * FROM students WHERE city = 'Manila';
        $students = DB::table('students')->where('city', 'Manila')->get();


        // Task#5 Retrieve students sorted by their age in descending order.
        // SQL Syntax: SELECT * FROM students ORDER BY age DESC;
        $students = DB::table('students')->orderBy('age', 'desc')->get();


        // Task#6 Retrieve students with their corresponding teacher.
        // SQL Syntax: SELECT students.*, teachers.name AS teacher_name  FROM students LEFT JOIN teachers ON students.teacher_id = teachers.id;
        $students = DB::table('students')
                    ->leftJoin('teachers', 'students.teacher_id', '=', 'teachers.id')
                    ->select('students.*', 'teachers.name as teacher_name')
                    ->get();


        // Task#7 Retrieve teachers along with the number of students they teach.
        // SQL Syntax: SELECT teachers.*, COUNT(students.id) AS student_count FROM teachers LEFT JOIN students ON teachers.id = students.teacher_id GROUP BY teachers.id;
        $teachers = DB::table('teachers')
                    ->leftJoin('students', 'teachers.id', '=', 'students.teacher_id')
                    ->select('teachers.*', DB::raw('COUNT(students.id) as student_count'))
                    ->groupBy('teachers.id')
                    ->get();


        // Task#8 Retrieve students with their corresponding subjects.
        // SQL Syntax: SELECT students.*, subjects.name AS subject_name FROM students INNER JOIN subjects ON students.subject_id = subjects.id;
        $students = DB::table('students')
                    ->join('subjects', 'students.subject_id', '=', 'subjects.id')
                    ->select('students.*', 'subjects.name as subject_name')
                    ->get();


        // Task#9 Retrieve students along with their average scores.
        // SQL Syntax: SELECT students.*, AVG(scores.score) AS average_score FROM students LEFT JOIN scores ON students.id = scores.student_id GROUP BY students.id;
        $students = DB::table('students')
                    ->leftJoin('scores', 'students.id', '=', 'scores.student_id')
                    ->select('students.*', DB::raw('AVG(scores.score) as average_score'))
                    ->groupBy('students.id')
                    ->get();


        // Task#10 Retrieve top 5 teachers with the highest number of students.
        // SQL Syntax: SELECT teachers.*, COUNT(students.id) AS student_count 
        // FROM teachers 
        // LEFT JOIN students ON teachers.id = students.teacher_id 
        // GROUP BY teachers.id 
        // ORDER BY student_count DESC 
        // LIMIT 5;
        $teachers = DB::table('teachers')
                    ->leftJoin('students', 'teachers.id', '=', 'students.teacher_id')
                    ->select('teachers.*', DB::raw('COUNT(students.id) as student_count'))
                    ->groupBy('teachers.id')
                    ->orderBy('student_count', 'desc')
                    ->limit(5)
                    ->get();


