<?php 
    $articles = getArticles();
    $users = getUsers();  


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
    if ($req->rowCount() >= 1)
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
    $req->execute(array($id));
    if ($req->rowCount($id)) 
    {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data; 
    }
    $req->closeCursor();
}

function getArticlesById($id) {
    require('db.php');
    $req = $bdd->prepare("SELECT * FROM article WHERE authorid = ?");
    $req->execute(array($id));
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
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
    if ($req->rowCount($id))  {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data;
    }
    return false;
    $req->closeCursor();
}

function deleteArticle($id) {
    require('db.php');


    $reqselectcom = $bdd->prepare("SELECT id FROM comment WHERE authorid = ?");
    $reqselectcom->execute(array($id));
    if ($reqselectcom->rowCount() >= 1) {
        $commentarticle = $reqselectcom->fetchAll(PDO::FETCH_OBJ);
        foreach($commentarticle  as $comment): 
            deleteComment($comment->id);
        endforeach;
    }

    $reqselectlike = $bdd->prepare("SELECT id FROM Likes WHERE articleid = ?");
    $reqselectlike->execute(array($id));
    if ($reqselectlike->rowCount() >= 1) {
        $likearticle = $reqselectlike->fetchAll(PDO::FETCH_OBJ);
        foreach($likearticle  as $like): 
            deleteLike($like->id);
        endforeach;
    }
    

    $req = $bdd->prepare("DELETE from article WHERE id = ?");
    $req->execute(array($id));
    $req->closeCursor();
}

function addComment($contenu, $articleid, $authorid) {

    require('db.php');
    $req = $bdd->prepare("INSERT INTO comment (contenu, articleId, nb_like, authorid, date) VALUES (?,?,?,?, NOW())");
    $req->execute(array($contenu,intval($articleid),0,$authorid));
    $req->closeCursor();
}


function getComments($id) {

    require('db.php');
    $req = $bdd->prepare("SELECT * from comment WHERE articleid = ?");
    $req->execute(array($id));
    $data = $req->fetchAll(PDO::FETCH_OBJ);
    return $data;
    $req->closeCursor();
}


function deleteComment($id) {
    require('db.php');
    $req = $bdd->prepare("DELETE FROM comment WHERE id = ?");
    $req->execute(array($id));
    $req->closeCursor();
}

// retourne l'article épingler
function getPinned() {
    require('db.php');
    $req = $bdd->prepare("SELECT * FROM article WHERE isPinned =?");
    $req->execute(array(1));
    if ($req->rowCount() >=1) {
        $data = $req->fetch(PDO::FETCH_OBJ);
    }
    else {
        $data = false;
    }
    return $data;
}


function pinneArticle($id, $valupdate) {

    require('db.php');
    $update = 0;
    $reqselect = $bdd->prepare("SELECT id, isPinned FROM article");
    $reqselect->execute();
    $data = $reqselect->fetchAll(PDO::FETCH_OBJ);
    $requpdate = $bdd->prepare("UPDATE article SET isPinned = ?  WHERE id = ?");
    foreach($data as $article) {
        if ($article->id === $id) {
            $update = $valupdate;
            
        }
        else {
            $update = 0;
            
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
    if ($req->rowCount() >= 1) {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data->id;
    }
    else {
        return false;
    }
    $req->closeCursor();

}
function getName($id) {
    require('db.php');
    $req = $bdd->prepare("SELECT id, pseudo FROM user WHERE id= ?");
    $req->execute(array($id));
    if ($req->rowCount() >= 1) {
        $data = $req->fetch(PDO::FETCH_OBJ);
        return $data->pseudo;
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
    $reqselect = $bdd->prepare("SELECT id FROM article WHERE authorid = ?");
    $reqselect->execute(array($id));
    $articlesuser = null;
    if ($reqselect->rowCount() >= 1) {
        $articlesuser = $reqselect->fetchAll(PDO::FETCH_OBJ);
        foreach($articlesuser as $article): 
            deleteArticle($article->id);
        endforeach;
    }

    $req = $bdd->prepare("DELETE  from user WHERE id = ?");
    $req->execute(array($id));
    $req->closeCursor();
}

function searchArticles($words) {
    if (!empty($words)) {
        require('db.php');
        $articlesValid = [];
        $articles = getArticles();

        foreach ($articles as $article):
                if (is_numeric(strpos(strtolower($article->titre),$words)) || is_numeric(strpos(strtolower($article->contenu),$words))) {  // verifie la presence d'un mots dans une chaine de caractere 
                    array_push($articlesValid, $article);
                }
            
        endforeach;
        return $articlesValid;
    }
    else 
        return "Pas d'articles trouvées";

}

function addLike($articleid, $userid) {
    require('db.php');
    $req = $bdd->prepare("INSERT INTO Likes (articleid, authorid) VALUES (?,?)");
    $req->execute(array($articleid,$userid));

    $req->closeCursor();
    
}

function deleteLike($articleid, $userid) {
    require('db.php');
    $req = $bdd->prepare("DELETE from Likes WHERE articleid = ? && authorid = ?");
    $req->execute(array($articleid, $userid));
    
    $req->closeCursor();

}
// verifie si un user a un like sur un article
function hasLikesBy($articleid,$userid) :bool {
    require('db.php');
    $req = $bdd->prepare("SELECT * FROM Likes WHERE articleid = ? AND authorid = ?");
    $req->execute(array($articleid, $userid));
    if ($req->rowCount() >= 1) 
        return true;
    return false;
    $req->closeCursor();
}

function updateNbLikes($articleid,$op) {
    require('db.php');
    $reqselect = $bdd->prepare("SELECT nbLikes FROM article  WHERE id = ?");
    $reqselect->execute(array($articleid));
    $data= $reqselect->fetch(PDO::FETCH_OBJ);

    $requpdate = $bdd->prepare("UPDATE article SET nbLikes = ? WHERE id = ?");
    if ($op === '1') {
        $requpdate->execute(array($data->nbLikes + 1,$articleid));
    } else {
        $requpdate->execute(array($data->nbLikes - 1,$articleid));
    }


    $reqselect->closeCursor();
    $requpdate->closeCursor(); 
}


function updatePseudo($userid, $newpseudo) {
    require('db.php');  
    $req = $bdd->prepare("UPDATE user SET pseudo = ? WHERE id = ?");
    $req->execute(array($newpseudo,$userid));
    $req->closeCursor();
}


function updatePassword($userid, $newpassword) {
    require('db.php');  
    $req = $bdd->prepare("UPDATE user SET password = ? WHERE id = ?");
    $req->execute(array($newpassword,$userid));
    $req->closeCursor();
}



function updateRole($id, $role) {
    require('db.php');
    $requpdate = $bdd->prepare("UPDATE user SET role = ? WHERE id = ?");
    $requpdate->execute(array($role,$id));
    $requpdate->closeCursor();
}
?>
