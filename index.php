<?php

    include('configure/database_connect.php');

    $sql = 'SELECT id, title, lists from items ord ORDER BY created_at';
    $result = mysqli_query($conn, $sql);
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);
    mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">

    <?php include('templates/header.php'); ?>

    <h4 class="center grey-text">Explore!</h4>

    <div class="container">
        <div class="row">
            <?php foreach($items as $item): ?>
                <div class="col s6 md3">
                    <div class="card">
                        <img src="image/icon.svg" alt="icon" class="icon">
                        <div class="card-content center">
                            <h6><b><?php echo htmlspecialchars($item['title']); ?></b></h6>
                            <ul>
                                <?php foreach(explode(',', $item['lists']) as $lis): ?>
                                    <li><?php echo htmlspecialchars($lis) ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>

                        <div class="card-action center">
                            <a href="details.php?id=<?php echo $item['id']; ?>" class="brand-text">more info</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>


    <?php include('templates/footer.php'); ?>

</html>