<?php
require_once('connect.php');
$sql = "SELECT * FROM articles a
        INNER JOIN categories c
        ON a.id_category = c.id";

$result = mysqli_query($conn, $sql);


function trDate($date){
    $dateArray = (explode("-",substr(($date),0,10)));
    $dateIns = $dateArray[2]."/".$dateArray[1]."/".$dateArray[0];
    return $dateIns;
}
?>
<?php require_once('partials/header.inc');?>
<div class="container">
    <div class="bg-light text-center p-5">
        <h1>Les articles</h1>
    </div>

    <div>
        <div class="row row-cols-2 row-cols-md-2 g-6 mt-2 mr-4 ml-4">
        <?php while($rows = mysqli_fetch_assoc($result)){ ?>
            <div class="col">
              <div class="card">
                <img src="assets/images/<?=$rows['image'];?>" class="card-img-top" alt="..." height="300">
                <div class="card-body">
                  <h4 class="card-title text-center"><?=$rows['title'];?></h4>
                  <p class="text-right">
                  <?=$rows['description'];?>
                  </p><p class="text-left">
                  <strong><?=$rows['author'];?></strong>
                  </p>
                </div>
              </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php require_once('partials/footer.inc');?>