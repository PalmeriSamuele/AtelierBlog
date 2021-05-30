<?php 

function getArticles()
{
    require('db.php');
    $sql = "SELECT * from article ORDER BY id DESC";
    $req = $bdd->prepare($sql);
    $req->execute();
    $data =  $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
    $req->closeCursor();
}



function getArticle($id) 
{
    require('db.php');
    $req = $bdd->prepare("SELECT * FROM article WHERE id = ?");
    $req->execute(array($id));
    if ($req->rowCount($id)) 
    {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data; 
    }

}

function getUsers()  
{

    require('db.php');
    $sql = "SELECT id, pseudo, email, nbArticles FROM user ORDER BY nbArticles desc";
    $req = $bdd->prepare($sql);
    $req->execute();
    $data =  $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
    $req->closeCursor();
}

function getUser($id) 
{

    require('db.php');
    $req = $bdd->prepare("SELECT * FROM user WHERE id = ?");
    $req->execute( array($id));
    if ($req->rowCount($id)) 
    {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data; 
    }
    $req->closeCursor();
}


function addArticle($titre, $contenu, $authorid) 
{
    require('db.php');
    // if (strlen($contenu) <= 3) return 'short';
    // if (strlen($titre)===0 ) return 'notitle';
    // if (strlen($titre) >= 10) return 'Ttoolong';
    // if (strlen($contenu >= 2000)) return 'Atoolong';
    $req = $bdd->prepare("INSERT INTO article(titre, contenu, authorid,date) VALUES (?,?,?,NOW())");
    $req->execute(array($titre,$contenu,$authorid));       
    $req->closeCursor();
    
}



function checkIfExist($pseudo, $password) : bool {
    require('db.php');

    $rep = false;
    $sql = "SELECT id, password, email ,pseudo FROM user ";
    $req = $bdd->prepare($sql);
    $req->execute();
    $data =  $req->fetchAll(PDO::FETCH_OBJ);
    foreach ($data as $user) {
        if (($user->email === $pseudo or $user->pseudo === $pseudo) && $user->password === $password) {
            $rep = true;
            return $rep;
        }
    }
    return $rep;
    $req->closeCursor();
}


function signUp($pseudo, $email, $mdp) :bool{
    require('db.php');
    if (!checkIfExist($pseudo,$mdp)) {
        $req = $bdd->prepare("INSERT INTO user(pseudo,password,email,version) VALUES (?,?,?,NOW())");
        $req->execute(array($pseudo,$mdp,$email)); 
        return true;
        
    }
    return false;
    $req->closeCursor();


}

function checkPermission($id) {
    require('db.php');
    $req = $bdd->prepare("SELECT role from user WHERE id = ?");
    $req->execute(array($id));
    $data = $req->fetch(PDO::FETCH_OBJ);
    return $data;
    $req->closeCursor();
}

function deleteArticle($id) {
    require('db.php');
    $req = $bdd->prepare("DELETE from article WHERE id = ?");
    $req->execute(array($id));
    $req->closeCursor();
}

function addComment($contenu, $articleid, $author) {

    require('db.php');
    $req = $bdd->prepare("INSERT INTO comment (contenu, articleId, nb_like, author, date) VALUES (?,?,?,?, NOW())");
    $req->execute(array($contenu,intval($articleid),0,$author));
    $req->closeCursor();
}


function getComments($id) {

    require('db.php');
    $req = $bdd->prepare("SELECT * from comment WHERE articleId = ?");
    $req->execute(array($id));
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
    $req->closeCursor();
}


function deleteComment($id) {
    require('db.php');
    $req = $bdd->prepare("DELETE from comment WHERE id = ?");
    $req->execute(array($id));
    $req->closeCursor();
}


function isPinned() {
    require('db.php');
    $req = $bdd->prepare("SELECT * FROM article WHERE isPinned =?");
    $req->execute(array(1));
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
}


function pinneArticle($id) {

    require('db.php');
    $update = 0;
    $reqselect = $bdd->prepare("SELECT id, isPinned FROM article");
    $reqselect->execute();
    $data = $reqselect->fetchAll(PDO::FETCH_OBJ);
    $requpdate = $bdd->prepare("UPDATE article SET isPinned = ?  WHERE id = ?");
    foreach($data as $article) {
        if ($article->isPinned == 1) {
            $update = 0;
            
        }
        else if ($article->id == $id) {
            $update = 1;
            
        }
        $requpdate->execute(array($update,$article->id));
    }

    $reqselect->closeCursor();
    $requpdate->closeCursor();
}

function getId($name) {
    require('db.php');
    $req = $bdd->prepare("SELECT id FROM user WHERE pseudo= ? OR email= ?");
    $req->execute(array($name,$name));
    $data = $req->fetch(PDO::FETCH_OBJ);
    if (isset($data)) {
        return $data->id;
    }
    else {
        return false;
    }
    $req->closeCursor();

}

function updateNbArticles($id, $operator) {
    require('db.php');
    $req = $bdd->prepare("SELECT nbArticles FROM user where id = ?");
    $req->execute(array($id));
    $data = $req->fetch(PDO::FETCH_OBJ);
    $requpdate = $bdd->prepare("UPDATE user SET nbArticles = ? WHERE id = ?");
    if ($operator === '-') {  
        $nbArticles = $data->nbArticles-1;
    }
    else {
        $nbArticles = $data->nbArticles+1;
    }
    $requpdate->execute(array($nbArticles,$id));
    $req->closeCursor();
    $requpdate->closeCursor();
} 




function deleteUser($id) {
    require('db.php');
    $req = $bdd->prepare("DELETE  from user WHERE id = ?");
    $req->execute(array($id));
    $req->closeCursor();
}

function searchArticles($words) {
    require('db.php');
    $articlesValid = [];
    $articles = getArticles();
    foreach ($articles as $article):
        if (strpos($article->titre,$words) || strpos($article->contenu,$words)) {
            array_push($articlesValid, $article);
        }
    endforeach;

    return $articlesValid;
}
?>