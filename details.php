<?php
    include('configure/database_connect.php');

    if(isset($_POST['delete'])){
        $id_to_delete = mysqli_real_escape_string($conn, $_POST['id_to_delete']);
        $sql = "DELETE FROM items WHERE id = $id_to_delete";
        if(mysqli_query($conn, $sql)){
            header('Location: index.php');
        }
        else{
            echo 'query error: ' . mysqli_error($conn);
        }
    }

    if(isset($_GET['id'])){
        $id = mysqli_real_escape_string($conn, $_GET['id']);
        $sql = "SELECT * FROM items WHERE id = $id";
        $result = mysqli_query($conn, $sql);
        $item = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        mysqli_close($conn);
    }
?>

<!DOCTYPE html>
<html lang="en">
    <?php include('templates/header.php'); ?>

    <div class="container center">
        <?php if($item): ?>
            <h4><?php echo htmlspecialchars($item['title']); ?></h4>
            <p>Created by: <?php echo htmlspecialchars($item['email']); ?></p>
            <p>Created at: <?php echo $item['created_at']; ?></p>
            <p>Lists: <?php echo htmlspecialchars($item['lists']); ?></p>

            <form action="details.php" method="POST">
                <input type="hidden" name="id_to_delete" value="<?php echo $item['id']; ?>">
                <input type="submit" name="delete" value="Delete" class="btn brand-color" >
            </form>

        <?php else: ?>
            <h4>No such item exists!</h4>
        <?php endif; ?>
    </div>

    <?php include('templates/footer.php'); ?>
</html>