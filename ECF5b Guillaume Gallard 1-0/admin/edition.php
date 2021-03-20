<?php
require_once('../security.inc');
require_once('../connect.php');
$error = "";

$sql1 = "SELECT id, name FROM categories";
$res = mysqli_query($conn, $sql1);

if(isset($_GET['id']) && $_GET['id'] <= 1000 && filter_var($_GET['id'], FILTER_VALIDATE_INT)){
    $id = htmlspecialchars(addslashes($_GET['id']));
    $sql2 = "SELECT * FROM articles a
            INNER JOIN categories c
            ON a.id_category = c.id
            WHERE a.id_a = '$id'";
    $result = mysqli_query($conn, $sql2);
    // var_dump($result);
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);

        // var_dump($data);
    }
}


if(isset($_POST['sent'])){
    $title = trim(htmlspecialchars(addslashes($_POST['title'])));
    $author = trim(htmlspecialchars(addslashes($_POST['author'])));
    $id_category = trim(htmlspecialchars(addslashes($_POST['category'])));
    $description= trim(htmlspecialchars(addslashes($_POST['desc'])));
    $image = $_FILES['image']['name'];

    $destination = "../assets/images/";
    move_uploaded_file($_FILES['image']['tmp_name'], $destination.$image);

    $id_a = trim(htmlspecialchars(addslashes($_POST['id_a'])));
    $sql3 = "SELECT image FROM articles a
            WHERE a.id_a = '$id_a'";
    $result = mysqli_query($conn, $sql3);
    // var_dump($result);
    if(mysqli_num_rows($result) > 0){
        $data = mysqli_fetch_assoc($result);

        // var_dump($data);
    }
        if(empty($image)){
            $sql4 = "UPDATE articles
                    SET title = '$title',
                        author = '$author',
                        id_category = '$id_category',
                        description = '$description'
            WHERE id_a = '$id_a'";
        }else{
            if(file_exists('../assets/images/'.$data['image'])){
                copy('../assets/images/'.$data['image'], '../assets/archives/'.$data['image']);
                unlink('../assets/images/'.$data['image']);
            }
            $sql4 = "UPDATE articles
            SET title = '$title',
                author = '$author',
                id_category = '$id_category',
                description = '$description',
                image = '$image'
            WHERE id_a = '$id_a'";
        }

        $result2 = mysqli_query($conn, $sql4);
        if($result2){
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
    <input type="hidden" name="id_a" value="<?=$data['id_a'];?>">
    <div class="row">
    <div class="col-6">
        <label for="title">Titre</label>
        <input type="text" class="form-control" id="title" name="title" value="<?=$data['title'];?>" required>
    </div>
    <div class="col-6">
        <label for="author">Auteur</label>
        <input type="text" class="form-control" id="author" name="author" value="<?=$data['author'];?>" required>
    </div>
    </div>
    <div class="row">
    <div class="col">
        <label for="image">Photo</label>
        <input type="file" class="form-control" id="image" name="image" value="<?=$data['image'];?>">
        <img src="../assets/images/<?=$data['image']; ?>"width="60"/>
    </div>
    <div class="col">
        <label for="category">Catégorie</label>
        <select class="form-select" id="category" name="category" >
        <option value="<?=$data['id'];?>"><?=$data['name']?></option>
        <?php
        while($rows = mysqli_fetch_assoc($res)){
            if ($data['id'] !== $rows['id']) {;?>
                <option value="<?=$rows['id']; ?>"><?=$rows['name']; ?></option>;
            <?php
            }
        };?>
        </select>
    </div>
    </div>
    <div class="row">
    <div class="col mb-2">
        <label for="desc">Contenu de l'article</label>
        <textarea class="form-control" id="desc" name="desc" rows="10"><?=$data['description'];?></textarea>
    </div>

    </div>
    <button type="submit" class="btn btn-warning col-12" name="sent">Valider</button>
    </form>
</div>
<?php require_once('../partials/footer.inc');?>