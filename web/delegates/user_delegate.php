<?php
    
    function update_user_name($id, $name) {
        require_once __DIR__.'/../seed.php';
        
        $statement = $pdo->prepare("UPDATE users SET name=:name WHERE id=:id;");
        $statement->bindValue(':name', $name, PDO::PARAM_STR);
        $statement->bindValue(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

?>