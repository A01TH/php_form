<!DOCTYPE html>
<html lang="en">
<head>
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body{  
        background: linear-gradient(to right, #4CA1AF, #2C3E50);  
        background: #4b6cb7;  
        background: -webkit-linear-gradient(to right, #182848, #4b6cb7); 
        background: linear-gradient(to right, #182848, #4b6cb7); 

        }
    </style>
</head>
<body>
<?php
$name = $email = $group = $classDetails = $gender = $selectCourses = $agree = "";
$nameReq = $emailReq = $genderReq = $agreeReq =  "";
$check_all_req = 1;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $check_all_req = 0;
    if (empty($_POST["name"])) {
      $nameReq = "Name is required";
      $check_all_req += 1;
        } else {
      $name = test_input($_POST["name"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $check_all_req += 1;
        $nameReq = "Only letters and white space allowed";
      }
    }
    
    if (empty($_POST["email"])) {
      $emailReq = "Email is required";
      $check_all_req += 1;
        } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailReq = "Invalid email format";
        $check_all_req += 1;
      }
    }
      
    if (empty($_POST["group"])) {
      $group = "";
        } else {
      $group = test_input($_POST["group"]);
      $group = preg_replace("/[^0-9]/", "",$group);
      
    }
  
    if (empty($_POST["classDetails"])) {
      $classDetails = "";
        } else {
      $classDetails = test_input($_POST["classDetails"]);
    }
  
    if (empty($_POST["gender"])) {
      $genderReq = "Gender is required";
      $check_all_req +=1;
     } else {
      $gender = test_input($_POST["gender"]);
    }


    if(isset($_POST["arr"]))
        {
          $selectCourses = "";
            foreach ($_POST['arr'] as $arr)
            $selectCourses .=  $arr ." ";
            
        }
    }


    if (empty($_POST["agree"])) {
      $selectCourses = "You must agree to terms";
      $check_all_req += 1;
        } else {
      $agree = test_input($_POST["agree"]);

    }

        
  
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    } 

?>   

    <div class="container mt-5">
        <h1 class="text-white">Application name: AAST_BIS class registration</h1>
        <h3 class="text-danger">* Required field</h3>
        <form action="<?php $_PHP_SELF?>" method="POST">
            <div class="form-group row m-2">
                <label for="Name" class="col-sm-1 col-form-label text-white"><strong class="h5">Name:</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
                </div>
                <strong class="text-danger col-auto h4">*<?php echo $nameReq;?></strong>
            </div>

            <div class="form-group row m-2">
                <label for="Name" class="col-sm-1 col-form-label text-white"><strong class="h5">E-mail:</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="email" value="<?php echo $email;?>">
                </div>
                <strong class="text-danger col-md-3 h4">*<?php echo $emailReq;?></strong>
            </div>

            <div class="form-group row m-2">
                <label for="Name" class="col-sm-1 col-form-label text-white"><strong class="h5">Group#</strong></label>
                <div class="col-sm-4">
                    <input type="text" class="form-control" name="group" value="<?php echo $group;?>">
                </div>
            </div>

            <div class="form-group row m-2">
                <label for="Name" class="col-sm-1 col-form-label text-white"><strong class="h5">Class details:</strong></label>
                <div class="col-sm-5">
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="classDetails"
                     value="<?php echo $classDetails;?>"><?php echo $classDetails;?></textarea>
                </div>
            </div>

            <div class="form-group row m-2 text-white">
                <label for="Name" class="col-1 col-form-label text-white"><strong class="h5">Gender:</strong></label>
                <div class="col-auto  align-self-center">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" 
                        <?php if (isset($gender) && $gender=="Female") echo "checked";?> value="Female">
                        <label class="form-check-label" for="inlineRadio1">Female</label>
                      </div>
                      <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" 
                        <?php if (isset($gender) && $gender=="Male") echo "checked";?> value="Male">
                        <label class="form-check-label" for="inlineRadio2">Male</label>
                      </div>
                </div>
                <strong class="text-danger  align-self-center col -3 h4">*<?php echo $genderReq;?></strong>
            </div>
  
            <div class="form-group row m-2">
                <label for="Name" class="col-2 align-self-center col-form-label text-white"><strong class="h5">Select Courses:</strong></label>
                <div class="col">
                        <select id="multiple-checkboxes" multiple="multiple" name="arr[]">
                        <option value="PHP">PHP</option>
                        <option value="Java Script">Java Script</option>
                        <option value="MySQL">MySQL</option>
                        <option value="HTML">HTML</option>
                    </select>
                </div>
            </div>

            <div class="form-group row m-2 text-white" >
                <label for="Name" class="col-sm-1 col-form-label text-white"><strong class="h5">Agree:</strong></label>
                <div class="form-check col  align-self-center">
                <input class="form-check-input " type="checkbox" name="agree" value="agree" id="flexCheckDefault"
                <?php if (isset($agree) && $agree=="agree") echo "checked";?>>
                    <label class="form-check-label" for="flexCheckDefault">
                    <strong class="text-danger col-auto h4 ">*<?php echo $agreeReq;?></strong></label>
                </div>
                
            </div>

            <div class="form-group row m-2 text-white">
                <button type="submit" class="btn btn-primary col-sm-2 btn-lg me-3">Submit</button>
            </div>
            
        </form>

        <div class="text-white h5 col-4">
            <?php
            if($check_all_req == 0){
            echo "<h2 class='text-warning'>Your given values are as:</h2>";
            echo "Name: " . $name;
            echo "<br>";
            echo "E-mail: " . $email;
            echo "<br>";
            echo "Group #: " . $group;
            echo "<br>";
            echo "Class details: " . $classDetails;
            echo "<br>";
            echo "Gender: " . $gender;
            echo "<br>";
            echo "Your courses are: " . $selectCourses;
            }
            ?>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>
