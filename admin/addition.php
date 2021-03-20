<?php
require_once('../security.inc');
session_start();
if(!isset($_SESSION['auth'])){
    header('location:index.php');
}
require_once('../connect.php');
$error = "";
$sql = "SELECT id, name FROM categories";
$res = mysqli_query($conn, $sql);

if(isset($_POST['sent'])){
    $title = trim(htmlspecialchars(addslashes($_POST['title'])));
    $author = trim(htmlspecialchars(addslashes($_POST['author'])));
    $id_category = trim(htmlspecialchars(addslashes($_POST['category'])));
    $description= trim(htmlspecialchars(addslashes($_POST['desc'])));
    $image = $_FILES['image']['name'];

    $destination = "../assets/images/";
    move_uploaded_file($_FILES['images']['tmp_name'], $destination.$image);
    
    // var_dump($_POST);
    $sql2= "INSERT INTO articles(title, author, id_category, image, description)
            VALUES('$title','$author','$id_category', '$image', '$description')";
    $result = mysqli_query($conn, $sql2);
    if(mysqli_insert_id($conn) > 0){
        header('location:list.php');
    }else{
        $error = '<div class="alert alert-danger">Erreur d\'insertion</div>';
    }
}

require_once('../partials/header.inc');
?>
<div class="offset-2 col-8">
<h1 class="bg-dark text-center text-white">Administration</h1>
<h2>Formulaire d'ajout</h2>
    <?= $error; ?>
    <form action="<?=$_SERVER['PHP_SELF'];?>" method="post" enctype="multipart/form-data">
    <div class="row">
    <div class="col-6">
        <label for="title">Titre</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Entrer le titre de l'article" required>
    </div>
    <div class="col-6">
        <label for="author">Auteur</label>
        <input type="text" class="form-control" id="author" name="author" placeholder="Entrer le nom de l'auteur" required>
    </div>
    </div>
    <div class="row">
    <div class="col">
        <label for="image">Photo</label>
        <input type="file" class="form-control" id="image" name="image">
    </div>
    <div class="col">
        <label for="category">Catégorie</label>
        <select class="form-select" id="category" name="category" >
        <option>Choisir</option>
        <?php
        while($rows = mysqli_fetch_assoc($res)){
            ?>
            <option value="<?=$rows['id']; ?>"><?=$rows['name']; ?></option>
        <?php
    }
    ?>
        </select>
    </div>
    </div>
    <div class="row">
    <div class="col mb-2">
        <label for="desc">Contenu de l'article</label>
        <textarea  class="form-control" id="desc" name="desc" rows="10"></textarea>
    </div>

    </div>
    <button type="submit" class="btn btn-success col-12" name="sent">Valider</button>
    </form>
</div>
<?php require_once('../partials/footer.inc');?>