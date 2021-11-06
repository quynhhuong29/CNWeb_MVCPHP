<?php
include_once("../Model/M_Student.php");
class Ctrl_Student
{
    public function invoke(){
        if(isset($_GET['stid'])){
            $modelStudent = new Model_Student();
            $student = $modelStudent->getStudentDetail($_GET['stid']);
            include_once("../View/studentDetail.html");
        }
        else if(isset($_POST['insert'])){
            $modelStudent = new Model_Student();
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $age = $_REQUEST['age'];
            $university = $_REQUEST['university'];
            $modelStudent->insertStudent($id,$name,$age,$university);
            header("Location:C_Student.php");
        }  
        else if(isset($_GET['idDel'])){
            $modelStudent = new Model_Student();
            $id = $_GET['idDel'];
            $modelStudent->deleteStudent($id);
            $studentList = $modelStudent->getAllStudent();
            header("Location:C_Student.php?mod3='1'");
        }
        else if(isset($_POST['update'])){
            $modelStudent = new Model_Student();
            $id = $_REQUEST['id'];
            $name = $_REQUEST['name'];
            $age = $_REQUEST['age'];
            $university = $_REQUEST['university'];
            $modelStudent->updateStudent($id,$name,$age,$university);
            header("Location:C_Student.php?mod2='1'");
        }
        else if(isset($_POST['search'])){
            $modelStudent = new Model_Student();
            $check = $_POST['searchSelect'];
            $info = $_POST['txtSearch'];
            $students = $modelStudent->searchStudent($check,$info);
            if(sizeof($student) > 0){
                include_once("../View/resultSearch.html");
            }
            else{
                header("Location:C_Student.php?mod4='1'");
            }
        }
        else if(isset($_GET['id'])){
            $modelStudent = new Model_Student();
            $student = $modelStudent->getStudentDetail($_GET['id']);
            include_once("../View/updateStudent.html");
        }
        else if(isset($_GET['mod1'])){
            include_once("../View/insertStudent.html");
        }
        else if(isset($_GET['mod2'])){
            $modelStudent = new Model_Student();
            $studentList = $modelStudent->getAllStudent();
            include_once("../View/updateList.html");
        }
        else if(isset($_GET['mod3'])){
            $modelStudent = new Model_Student();
            $studentList = $modelStudent->getAllStudent();
            include_once("../View/deleteStudent.html");
        }
        else if(isset($_GET['mod4'])){
            include_once("../View/searchStudent.html");
        }
        else{
            $modelStudent = new Model_Student();
            $studentList = $modelStudent->getAllStudent();
            include_once("../View/studentList.html");
        }
    }
};

//Process
$C_Student = new Ctrl_Student();
$C_Student->invoke();
?>