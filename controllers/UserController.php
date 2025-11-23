<?php //Logic for loading the form
    require_once 'models/UserModel.php';

    class UserController {
        public function register() {
            //Setting up arrays with user data and error list
            $post = ['firstName' => '',
                    'lastName' => '',
                    'username' => '',
                    'email' => '',
                    'password' => '',
                    'passwordVer' => ''];
            $errors = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                //Fetching data and storing in $post array
                $post['firstName'] = trim($_POST['firstName'] ?? '');
                $post['lastName'] = trim($_POST['lastName'] ?? '');
                $post['username'] = trim($_POST['username'] ?? '');
                $post['email'] = trim($_POST['email'] ?? '');
                $post['password'] = trim($_POST['password'] ?? '');
                $post['passwordVer'] = trim($_POST['passwordVer'] ?? '');

                //Validating first name
                if ($post['firstName'] === '') {
                    $errors['firstName'] = "First name is required.";
                }

                //Validating last name
                if ($post['lastName'] === '') {
                    $errors['lastName'] = "Last name is required.";
                }

                //Validating username
                if ($post['username'] === '') {
                    $errors['username'] = "Username is required.";
                }

                //Validating email
                if ($post['email'] === '') {
                    $errors['email'] = "Email is required.";
                } else if (!filter_var($post['email'], FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Enter a valid email.";
                }

                //Validating password
                if ($post['password'] === '') {
                    $errors['password'] = 'Password required.';
                }

                //Verify passwords match
                if ($post['password'] !== $post['passwordVer']) {
                    $errors['passwordVer'] = 'Passwords must match.';
                }


                if (empty($errors)) {
                // Call the model to create a new user
                $userId = UserModel::createUser($post);

                // Check if the user was created successfully
                if ($userId) {
                    // Redirect to the profile view with the new user ID
                    header("Location: profile.php?id=$userId");
                    exit;
                } else {
                    // If there was a database error, add to errors
                    $errors['db'] = 'Failed to save user to database.';
                }
            }
            }
            require 'views/profile/create.php';
        }

        // Show user profile by ID
        public static function show() {
            // Get the user ID from the query string
            $id = $_GET['id'] ?? null;
            if (!$id) {
                echo "No user ID specified.";
                return;
            }

            // Fetch user data from the model
            $user = UserModel::getUserById($id);
            if (!$user) {
                echo "User not found.";
                return;
            }

            require 'views/profile/show.php';
        }
    }
?>