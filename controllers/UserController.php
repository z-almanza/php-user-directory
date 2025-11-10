<?php //Logic for loading the form
    require_once './models/UserModel.php';

    class UserController {

        public function register() { //Register method that loads registration form (create.php)
            $post = ['firstName' => '',
                    'lastName' => '',
                    'username' => '',
                    'email' => '',
                    'password' => '',
                    'passwordVer' => ''];
            $errors = [];

            //Check if request is POST, then validate data
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $post['firstName'] = trim($_POST['firstName'] ?? '');
                $post['lastName'] = trim($_POST['lastName'] ?? '');
                $post['username'] = trim($_POST['username'] ?? '');
                $post['email'] = trim($_POST['email'] ?? '');
                $post['password'] = trim($_POST['password'] ?? '');
                $post['passwordVer'] = trim($_POST['passwordVer'] ?? '');

                //Validating firstName
                if ($post['firstName'] === '') {
                    $errors['firstName'] = 'First name required';
                }

                //Validating lastName
                if ($post['lastName'] === '') {
                    $errors['lastName'] = 'Last name required';
                }

                //Validating username
                if ($post['username'] === '') {
                    $errors['username'] = 'Username required';
                }

                //Validating email
                if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = 'Enter valid email';
                }

                //Validating password
                if ($post['password'] === '') {
                    $errors['password'] = 'Password required';
                }

                //Matching passwords
                if ($post['password'] !== $post['passwordVer']) {
                    $errors['passwordVer'] = 'Passwords must match';
                }

            }

            //If no errors, user saved to database
            if (empty($errors)) {
                $userId = UserModel::createUser($post);

                if ($userId) {
                    header("Location: profile.php?id=$userId");
                    exit;
                }
                else { //Error added if user could not be added to database
                    $errors['db'] = "Failed to save user to database.";
                }
            }

            require './views/profile/create.php';
        }

        public static function show() { //Shows profile information 
            $id = $_GET['id'] ?? null;
            if (!$id) {
                echo "No user ID specified.";
                return;
            }

            $user = UserModel::getUserById($id);
            if (!$user) {
                echo "User not found.";
                return;
            }

            require './views/profile/show.php';
        }
    }
?>