<?php //Logic for loading the form
    require_once 'config/init.php';
    require_once BASE_PATH . '/models/UserModel.php'; //BASE_PATH . "path"

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
                    $userId = UserModel::createUser($post);
                    $_SESSION['userID'] = $post[$userId];
                    $_SESSION['username'] = $post['username'];
                    $_SESSION['role'] = $post['role'];

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
            require BASE_PATH . '/views/profile/create.php';
        }

        // Show user profile by ID
        public static function show() {
            // Get the user ID from the query string
            $id = $_GET['id'] ?? null;
            if (!$id) {
                echo "No user ID specified.";
                return;
            }

            //Checking that profile can be viewed if user is either admin or the profile owner
            if (!isset($_SESSION['role']) && $_SESSION['userID'] !== $id) {
                header("Location: profile.php?error=" . urlencode("You do not have permission to view this profile as an admin or designated user."));
                exit;
            }

            // Fetch user data from the model
            $user = UserModel::getUserById($id);
            if (!$user) {
                echo "User not found.";
                return;
            }

            require BASE_PATH . '/views/profile/show.php';
        }

        //Edit function takes user to edit page for specific user ID
        public static function edit() {
            //Checking that profile can be edited if user is either admin or the profile owner
            if ((!isset($_SESSION['role']) && $_SESSION['userID'] !== $_GET['id'])) {
                header("Location: profile.php?error=" . urlencode("You do not have permission to edit this profile."));
                exit;
            }

            $id = $_GET['id'] ?? null;
            //Ensures id/user exists
            if ($id) {
            $user = UserModel::getUserById($id);
            if ($user) {
                require BASE_PATH . '/views/profile/edit.php';
                return;
            }
            }
            //Otherwise, shows error
            header("Location: index.php?error=" . urlencode("We could not find you in the system."));
            exit;
        }

        //Update function sends data to UserModel
        public static function update() {
            if ((!isset($_SESSION['role']) && $_SESSION['userID'] !== $_GET['id'])) {
                header("Location: profile.php?error=" . urlencode("You do not have permission to edit this profile."));
                exit;
            }

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
            require BASE_PATH . '/views/profile/edit.php';
        }

        public static function deactivate() {
            if ($_SESSION['role'] !== 'admin') {
                header("Location: profile.php?error=" . urlencode("Unauthorized action."));
                exit;
            }

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
                require BASE_PATH . '/views/profile/deactivate.php';
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

                $user = UserModel::findByUsername($post['username']); 

                if ($user['is_blocked']) {
                    echo "Account is blocked. Please contact support,";
                    exit;
                }

                $_SESSION['userID'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                if ($user && password_verify($password, $user['password'])) {

                    $_SESSION['userID'] = $user['id'];  // Stores the user's ID for access checks
                    $_SESSION['username'] = $user['username']; // Stores their username for use across pages
                    $_SESSION['role'] = $user['role']; //Stores user's role for use across pages

                    setcookie('username', $user['username'], time() + 60*60*24*30); // Optional: greets returning users

                    
                        header("Location: profile.php?id=" . $user['id']); // Redirects to the protected user profile page
                        exit;
                    
                } else {
                    $errors['login'] = 'Invalid username or password.';
                }
            }
            require BASE_PATH . '/views/login.php';
        }

        public static function dashboard() {
            require_once BASE_PATH . '/models/UserModel.php';
            $users = UserModel::getAllUsers();
            require BASE_PATH . '/views/admin/dashboard.php';
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

        public static function delete() {
            if ($_SESSION['role'] !== 'admin') {
                header("Location: profile.php?error=" . urlencode("Unauthorized action."));
                exit;
            }
            require_once BASE_PATH . '/models/UserModel.php';

            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $id = $_POST['id'] ?? null;
                if ($id && UserModel::deleteUser($id)) {
                    header("Location: admin/dashboard.php?success=" . urlencode("User deleted."));
                    exit;
                }
                header("Location: admin/dashboard.php?error=" . urlencode("Failed to delete user."));
                exit;
            }

            $id = $_GET['id'] ?? null;
            if ($id) {
                require BASE_PATH . '/views/profile/delete-verify.php';
                return;
            }

            header("Location: admin/dashboard.php?error=" . urlencode("No user ID specified."));
            exit;
        }
    }
?>