<?php

require_once 'BaseModel.php';

class UserModel extends BaseModel
{

    public function findUserById($id)
    {
        $sql = 'SELECT * FROM users WHERE id = ' . $id;
        $user = $this->select($sql);

        return $user;
    }
     public function viewBanks($id) {
        $sql = "SELECT banks.cost FROM `users` INNER JOIN `banks` on `users`.`id` = `banks`.`user_id`
        WHERE `users`.`id` = $id";
        $user = $this->select($sql);
       
        return $user;
    }
    public function findUser($keyword)
    {
        $sql = 'SELECT * FROM users WHERE user_name LIKE %' . $keyword . '%' . ' OR user_email LIKE %' . $keyword . '%';
        $user = $this->select($sql);

        return $user;
    }

    /**
     * Authentication user
     * @param $userName
     * @param $password
     * @return array
     */
    public function auth($userName, $password)
    {
        $md5Password = md5($password);
        $sql = 'SELECT * FROM users WHERE name = "' . $userName . '" AND password = "' . $md5Password . '"';

        $user = $this->select($sql);
        return $user;
    }

    /**
     * Delete user by id
     * @param $id
     * @return mixed
     */
    public function deleteUserById($id)
    {
        $sql = 'DELETE FROM users WHERE id = ' . $id;
        return $this->delete($sql);
    }

    /**
     * Update user
     * @param $input
     * @return mixed
     */
    public function updateUser($input)
    {
        $sql = 'UPDATE users SET 
                 name = "' . $input['name'] . '", 
                 password="' . md5($input['password']) . '"
                WHERE id = ' . $input['id'];

        $user = $this->update($sql);

        return $user;
    }

    /**
     * Insert user
     * @param $input
     * @return mixed
     */
    public function insertUser($input)
    {

        $sql = "INSERT INTO `users`(`id`, `name`, `fullname`, `email`, `type`, `password`) VALUES (null,'" . $input['name'] . "','','','',MD5('" . $input['password'] . "'))";
        // $sql = "INSERT INTO `app_web1`.`users` (`name`, `password`) VALUES (" .
        //         "'" . $input['name'] . "', '".md5($input['password'])."')";

        $user = $this->insert($sql);

        return $user;
    }

    public function addBanks($id , $cost) {
        $sql =  parent::$_connection->prepare("INSERT INTO `banks`(`user_id`, `cost`) VALUES ($id , $cost)");
        return $sql-> execute();
    }
    /**
     * Search users
     * @param array $params
     * @return array
     */
    public function getUsers($params = [])
    {
        //Keyword
        if (!empty($params['keyword'])) {
            $sql = 'SELECT * FROM users WHERE name LIKE "%' . $params['keyword'] . '%"';

            //Keep this line to use Sql Injection
            //Don't change
            //Example keyword: abcef%";TRUNCATE banks;##
            $users = self::$_connection->multi_query($sql);
        } else {
            $sql = 'SELECT * FROM users';
            $users = $this->select($sql);
        }

        return $users;
    }

    // Fogot password
    public function ForgotPassword($email, $secrect_question, $answer, $password)
    {
        if (empty($email)) return false;
        if (empty($secrect_question)) return false;
        if (empty($answer)) return false;

        $sql = 'SELECT * FROM `users` WHERE `email` = "' . $email . '" AND `secrect_question` = "' . $secrect_question . '" AND `answer` = "' . $answer . '"';
        $forgot = $this->select($sql);

        if ($forgot != null) {
            $sql2 = 'UPDATE `users` SET `password`=MD5("'.$password.'") WHERE `email` = "'.$email.'"';
            $user = $this->update($sql2);

            return $user;
        }
        return false;
    }
    // get question
    public function getQuestion()
    {
        $sql = 'SELECT * FROM `question`';
        $question = $this->select($sql);

        return $question;
    }
}
