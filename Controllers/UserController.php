<?php
require_once 'Models/UserModel.php';
// require_once 'BaseController.php';
// class UserController extends BaseController
// {
//     private $model;
//     function __construct()
//     {
//         $this->model =  new UserModel();
//     }
//     function index()
//     {
//         $users = $this->model->getUsers();
//         $this->view('user/list', ['users' => $users]);
//     }
    

//     function edit($id)
//     {
//         $user = $this->model->getUser($id);
//         $this->view('user/edit',['user'=>$user]);
//     }
//     function update($id)
//     {
//         if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//             $data = [
//                 'FisrtName' => htmlspecialchars($_POST['FisrtName']),
//                 'LastName' => htmlspecialchars($_POST['LastName']),
//                 'email' => htmlspecialchars($_POST['email']),
//                 'password' => htmlspecialchars($_POST['password']),
//                 'image' => $_POST['image'],
//             ];
            
//             $this->model->updateUser($id, $data);
//             $this->redirect('/user');
//         }
//     }

//     function destroy($id)
//     {
//         if (isset($_POST['_method']) && $_POST['_method'] === 'DELETE') {
//             $this->model->deleteUser($id);
//             $this->redirect('/user');
//         }
//     }
// }
require_once 'Models/UserModel.php'; // Adjust path as needed

class UserController
{
    private $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function listUsers()
    {
        $users = $this->userModel->getUsers();
        include 'views/user/list.php'; // Pass data to your view
    }

    // Example of getting a single user.
    public function getUser($id)
    {
        $user = $this->userModel->getUser($id);
        if ($user) {
            //Do something with the user.
            var_dump($user);
        } else {
            echo "User not found.";
        }
    }

    //Example of updating a user
    public function updateUser($id, $data){
        $this->userModel->updateUser($id, $data);
        echo "User Updated";
    }

    //Example of deleting a user.
    public function deleteUser($id){
        $this->userModel->deleteUser($id);
        echo "User Deleted";
    }
}
?>