<?php
include_once("E_Student.php");
class Model_Student {
    public function __construct(){}
    public function getAllStudent(){
        $link=mysqli_connect("localhost", "root","") or die("Couldn't connect to database MYSQL");
        mysqli_select_db($link, "DULIEU");
        $sql="SELECT * FROM sinhvien";
        $rs=mysqli_query($link, $sql);
        $i=0;
        while($row=mysqli_fetch_array($rs)){
            $id=$row['id'];
            $name=$row['name'];
            $age=$row['age'];
            $university=$row['university'];

            while($i != $id) $i++;
            $students[$i++]=new Entity_Student($id,$name,$age,$university);
        }
        return $students;
    }

    public function getStudentDetail($stid){
        $allStudent=$this->getAllStudent();
        return $allStudent[$stid];
    }


    public function insertStudent($id, $name, $age, $university){
        $link=mysqli_connect("localhost", "root","") or die("Couldn't connect to database MYSQL");
        mysqli_select_db($link, "DULIEU");
        $sql="INSERT INTO sinhvien (id, name, age, university) VALUES ('$id', '$name', '$age', '$university')";
        // $rs=mysqli_query($link, $sql);
        if (mysqli_query($link, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function updateStudent($id, $name, $age, $university){
        $link=mysqli_connect("localhost", "root","") or die("Couldn't connect to database MYSQL");
        mysqli_select_db($link, "DULIEU");
        $sql="UPDATE sinhvien SET name='$name', age='$age', university='$university' WHERE id='$id'";
        // $rs=mysqli_query($link, $sql);
        if (mysqli_query($link, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    public function deleteStudent($id){
        $link=mysqli_connect("localhost", "root","") or die("Couldn't connect to database MYSQL");
        mysqli_select_db($link, "DULIEU");
        $sql="DELETE FROM sinhvien WHERE id='$id'";
        if (mysqli_query($link, $sql)) {
            echo "Record deleted successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($link);
        }
    }

    public function searchStudent($check, $info){
        $link=mysqli_connect("localhost", "root","") or die("Couldn't connect to database MYSQL");
        mysqli_select_db($link, "DULIEU");
        // if($check == 'ID'){ 
        //     $sql = "SELECT * FROM sinhvien WHERE id = 1";
        // }
        // if($check == 'Name'){
        //     $sql = "SELECT * FROM sinhvien WHERE name ='".$info."'";
        // }
        // if($check == 'Age'){
        //     $sql = "SELECT * FROM sinhvien WHERE age =".$info;
        // }
        // else if ($check == 'University'){
        //     $sql = "SELECT * FROM sinhvien WHERE university ='".$info."'";
        // }
        switch($check){
            case 'ID':
                $sql = "SELECT * FROM sinhvien WHERE id ='".$info."'";
                break;
            case 'Name':
                 $sql = "SELECT * FROM sinhvien WHERE name ='".$info."'";
                 break;
            case 'Age':
                $sql = "SELECT * FROM sinhvien WHERE age ='".$info."'";
                break;
            case 'University':
                $sql = "SELECT * FROM sinhvien WHERE university ='".$info."'";
                break;
        }
        $rs=mysqli_query($link, $sql);
        $i=1;
        while($row=mysqli_fetch_array($rs)){
            $id=$row['id'];
            $name=$row['name'];
            $age=$row['age'];
            $university=$row['university'];
            $students[$i++]=new Entity_Student($id,$name,$age,$university);
        }
        return $students;
    }
}

?>