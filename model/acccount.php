<?php
    function get_account($db, $username, $password) {
        $query = "SELECT id, userName, firstName, lastName, password FROM account_user WHERE username = :username";
        
        $statement = $db->prepare($query);
        $statement->bindValue(':username', $username);
        $statement->execute();
        
        $account = $statement->fetch(PDO::FETCH_ASSOC);
        $statement->closeCursor();
        
        if ($account && password_verify($password, $account['password'])) {
            return $account;
        } else {
            return false;
        }
    }

    function add_account($db, $firstName, $lastName, $username, $password, $email) {
        $query = "INSERT INTO account_user (firstName, lastName, username, password, email)
                  VALUES (:firstName, :lastName, :username, :password, :email)";
        
        $statement = $db->prepare($query);
        
        $statement->bindValue(':firstName', $firstName);
        $statement->bindValue(':lastName', $lastName);
        $statement->bindValue(':username', $username);
        $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT));
        $statement->bindValue(':email', $email);
        
        return $statement->execute();
    }
?>