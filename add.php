<?php

    include('configure/database_connect.php');
    
    $email = $title = $lists = '';
    $errors = array('email'=>'', 'title'=>'', 'lists'=>'');    

    if(isset($_POST['submit'])){

        if(empty($_POST['email'])){
            $errors['email'] = 'An email is required';
        }
        else{
            $email = $_POST['email'];
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                $errors['email'] = 'Email must be a valid email address';
            }
        }

        if(empty($_POST['title'])){
            $errors['title'] = 'A title is required';
        }
        else{
            $title = $_POST['title'];
            if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
                $errors['title'] = 'Title must be letters and spaces only';
            }
        }

        if(empty($_POST['lists'])){
            $errors['lists'] = 'At least one value is required';
        }
        else{
            $lists = $_POST['lists'];
            if(!preg_match('/^([a-zA-Z0-9\s]+)(,\s*[a-zA-Z0-9\s]*)*$/', $lists)){
                $errors['lists'] = 'Items must be a comma separated';
            }
        }

        if(!array_filter($errors)){
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $title = mysqli_real_escape_string($conn, $_POST['title']);
            $lists = mysqli_real_escape_string($conn, $_POST['lists']);
            $sql = "INSERT INTO items(title, email, lists) VALUES ('$title', '$email', '$lists')";
            if(mysqli_query($conn, $sql)){
                header('Location: index.php');
            }
            else{
                echo 'query error: ' . mysqli_error($conn);
            }           
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <section class="container grey-text">
        <h4 class="center">Add an Item</h4>
        <form class="white" action="add.php" method="POST">
            <label>Your Email:</label>
            <input type="text" name="email"  value="<?php echo htmlspecialchars($email); ?>">
            <div class="red-text"><?php echo $errors['email']; ?></div>

            <label>Favourite Title:</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($title); ?>">
            <div class="red-text"><?php echo $errors['title']; ?></div>

            <label>Lists:</label>
            <input type="text" name="lists" value="<?php echo htmlspecialchars($lists); ?>">
            <div class="red-text"><?php echo $errors['lists']; ?></div>
            
            <div class="center">
                <input type="submit" name="submit" value="submit" class="btn brand-color">
            </div>
        </form>
    </section>

    <?php include('templates/footer.php'); ?>

</html>