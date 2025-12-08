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
                
                if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $post['password'])) {
                    $errors['password'] = "Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters.";
                }

                //Verify passwords match
                if ($post['password'] !== $post['passwordVer']) {
                    $errors['passwordVer'] = 'Passwords must match.';
                }


                if (empty($errors)) {
                    // Call the model to create a new user
                    $post['password'] = UserController::encrypt_user_password($post['password']);
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

        //Edit function takes user to edit page for specific user ID
        public static function edit() {
            $id = $_GET['id'] ?? null;
            //Ensures id/user exists
            if ($id) {
            $user = UserModel::getUserById($id);
            if ($user) {
                require 'views/profile/edit.php';
                return;
            }
            }
            //Otherwise, shows error
            header("Location: index.php?error=" . urlencode("We could not find you in the system."));
            exit;
        }

        //Update function sends data to UserModel
        public static function update() {
            $id = $_POST['id'] ?? null;
            $firstName = trim($_POST['firstName'] ?? '');
            $lastName = trim($_POST['lastName'] ?? '');
            $username = trim($_POST['username'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = trim($_POST['password'] ?? '');
            $passwordVer = trim($_POST['passwordVer'] ?? '');

            $errors = [];

            if (!$firstName) $errors['firstName'] = "First name is required.";
            if (!$lastName) $errors['lastName'] = "Last name is required.";
            if (!$username) $errors['username'] = "Username is required.";
            if (!$email) $errors['email'] = "Email is required.";
            if ($email === '') {
                    $errors['email'] = "Email is required.";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors['email'] = "Enter a valid email.";
                }
            if (!$password) $errors['password'] = "Password is required.";
            if (!preg_match('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}/', $password)) {
                    $errors['password'] = "Must contain at least one number, one uppercase and lowercase letter, and at least 8 or more characters.";
                }
            if (!$passwordVer) $errors['passwordVer'] = "Re-enter password.";
            if ($password !== $passwordVer) $errors['passwordVer'] = "Passwords do not match.";

            if (empty($errors)) {
                if (UserModel::updateUser($id, $firstName, $lastName, $username, $email, $password)) {
                    UserController::update_user_password($id, $password);
                    header("Location: profile.php?id=$id&success=" . urlencode("Profile updated successfully."));
                    exit;
                } else {
                    $errors[] = "Failed to update user.";
                }
            }

            $user = ['id' => $id, 'firstname' => $firstName, 'lastname' => $lastName, 'username' => $username, 'email' => $email, 'password' => $password];
            require 'views/profile/edit.php';
        }

        public static function deactivate() {
            $id = $_POST['id'] ?? $_GET['id'] ?? null;

            // Check server request method is POST
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // Check for POST $id and db update success
                if ($id && UserModel::deactivateUser($id)) {
                header("Location: index.php?deactivate=success");
                exit;
                }
                header("Location: index.php?error=failed");
                exit;
            }

            // Check for GET $id, select db record and load the deactivate.php view
            if ($id && $user = UserModel::getUserById($id)) {
                require 'views/profile/deactivate.php';
                return;
            }

            header("Location: index.php?error=notfound");
            exit;
        }

        public function login_user() {
            $post = ['username' => ''];
            $errors = [];

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $post['username'] = trim($_POST['username'] ?? '');
                $password = trim($_POST['password'] ?? '');

                $user = UserModel::findByUsername($post['username']); //changed to usermodel::

                if ($user && password_verify($password, $user['password'])) {

                    $_SESSION['userID'] = $user['id'];  // Stores the user's ID for access checks
                    $_SESSION['username'] = $user['username']; // Stores their username for use across pages

                    setcookie('username', $user['username'], time() + 60*60*24*30); // Optional: greets returning users
                    
                    header("Location: profile.php?id=" . $user['id']); // Redirects to the protected user profile page
                    exit;
                } else {
                    $errors['login'] = 'Invalid username or password.';
                }
            }
            require 'views/login.php';
        }

        public static function logout_user() {
            session_unset();
            session_destroy();
            header('Location: login.php?msg=logged_out');
            exit;
        }

        public static function encrypt_user_password($password) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            return $hashedPassword;
        }
        
        public static function update_user_password($userId, $newPassword) {
            $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
            return UserModel::update_password_by_id($userId, $hashedPassword);
        }
    }
?>