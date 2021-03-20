<?php
require_once('security.inc');
require_once('../connect.php');

// if(isset($_POST['submit']) && !empty($_POST['search'])){
//     $mCle = trim(addslashes(htmlentities($_POST['search'])));
//     $sql = " SELECT * FROM articles a
//     INNER JOIN categories c
//     ON p.id = c.id
//     WHERE nom LIKE '$mCle%' OR name LIKE '$mCle%'";
// }else{

$sql = "SELECT * FROM articles a
        INNER JOIN categories c
        ON a.id_category = c.id";
// }

$result = mysqli_query($conn, $sql);

?>

<?php require_once('../partials/header.inc'); ?>

<div class="container">

<h1>Liste des articles</h1>
<p><a href="addition.php" class="btn btn-warning"><i class="fas fa-plus"> Ajouter </i></a></p>
<form action="<?=$_SERVER['PHP_SELF']; ?>" method="post">
    <div class="input-group justify-content-end">
        <input type="search" class="form-control offset-9 col-3 text-center" name="search" id="search" placeholder="Rechercher">
        <button type="submit" name="submit"><i class="fas fa-search"></i></button>
    </div>
</form>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Titre</th>
            <th>Auteur</th>
            <th>Image</th>
            <th>Contenu</th>
            <th>Date</th>
            <th>Catégorie</th>
            <?php
            if(isset($_SESSION['auth']) && $_SESSION['auth']['role']==1){
                ?>
            <th colspan="2" class="text-center">Actions</th>
            <?php } ?>
        </tr>
    </thead>
    <tbody>
    <?php while($rows = mysqli_fetch_assoc($result)){ ?>
        <tr>
            <td><?= $rows['id_a']; ?></td>
            <td><?= $rows['title']; ?></td>
            <td><?= $rows['author']; ?></td>
            <td><img src="../assets/images/<?=$rows['image']; ?>"width="60"/></td>
            <td><?= $rows['description']; ?></td>
            <td><?= $rows['date']; ?></td>
            <td><?= $rows['name']; ?></td>
            <!-- <?php 
            // if(isset($_SESSION['auth']) && $_SESSION['auth']['role']==1){ 
                ?> -->
            <td><a href="edition.php?id=<?=$rows['id_a'];?>" class="btn btn-success"><i class="fas fa-edit"></a></td>
            <td><a href="deletion.php?id=<?=$rows['id_a'];?>" class="btn btn-danger" onclick="return confirm('Etes vous sûr de vouloir supprimer?')"><i class="fas fa-trash"></i></a></td>
            <?php } ?>
            </tr>
    <!-- <?php 
// } 
?> -->
    </tbody>
</table>
</div>
<?php require_once('../partials/footer.inc'); ?>
