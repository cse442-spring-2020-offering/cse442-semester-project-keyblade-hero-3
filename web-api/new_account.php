<?php
    
    if (!isset($_SESSION)) 
    {
     session_start();
    }

   require 'database_connect.php';
   date_default_timezone_set('America/New_York');
   // the response will be a JSON object
   header('Content-Type: application/json');
   header('Access-Control-Allow-Origin: *');
   header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
   // pull the input, which should be in the form of a JSON object
   $json_params = file_get_contents('php://input');
   $decoded_params = json_decode($json_params, TRUE);
   //print_r($decoded_params);
   $conn = null;
   $conn = connect();
   $username = null;
   $email = null;
   $phone = null;
   $pass = null;
   $salt = null;

   $sql = "INSERT INTO Users (username, password, email, phone, salt_value) VALUES (:username, :pass, :email, :phone, :salt)";
   $stmt = $conn->prepare($sql);
   $stmt->bindParam(':username', $username);
   $stmt->bindParam(':pass', $pass);
   $stmt->bindParam(':email', $email);
   $stmt->bindParam(':phone', $phone);
   $stmt->bindParam(':salt', $salt);
   
   //$user_id = 9999;
   //$del_id = 9999;
   //$status = "pending";
   //$price = 9999.99;
   //$items = "dummies";


   $username = $decoded_params[username];
   $pass = $decoded_params[pass];
   $email = $decoded_params[email];
   $phone = $decoded_params[phone];
   $salt = $decoded_params[salt_value];

   //$username = "test";
   //$pass = "badpass";
   //$email = "whatever@notreal.com";
   //$phone = "999-999-9999";

   $stmt->execute();
   print_r($conn->lastInsertID());
   $conn = null;

   //echo json_encode($_POST);
//     $json_params = file_get_contents('php://input');
//     $decoded_params = json_decode($json_params, TRUE);
//     $conn = null;
//     if(is_array($decoded_params) && array_key_exists('post_id', $decoded_params)){
//         $post_id = $decoded_params['post_id'];
//     }
//     if(is_array($decoded_params) && array_key_exists('content', $decoded_params)){
//         $post_id = $decoded_params['content'];
//     }
//     //$_SESSION['user_id'] = 99999;
//     if(isset($_POST['action']) && !empty($_POST['action'])) {
//         $action = $_POST['action'];
//     if(isset($_POST['postid']) && !empty($_POST['postid'])) {
//        $post_id = $_POST['postid'];
//     }
//     // if(isset($_POST['tag']) && !empty($_POST['tag'])) {
//     //    $tag = $_POST['tag'];
//     // }
//    $user_id=$_SESSION['u_id'];
//             switch($action) {
//                 case 'on-load': on_load_order(); break;
//                 case 'update_order': update_order(); break;
//                 case 'verify_order': verify_order(); break;
//                 case 'create_order': create_order(); break;
//                 default: echo "No such function";
//             }
       
//     }

//     function on_load_order(){
//         $conn = connect();

//         //prepare statement

//         //collect data
//     }

//     function update_order(){
//         $conn = connect();

//         //prepare statement

//         //update orders
//     }

//     function verify_order($order_number){
//         $conn = connect();
//     }

//     function create_order(){
//         $conn = connect();
//     }

?>