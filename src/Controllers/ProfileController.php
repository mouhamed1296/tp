<?php
namespace App\Controllers;
use App\Repositories\UserRepository;

class ProfileController
{
    public function updatePassword($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true){
            $userRepository = new UserRepository();
            $ancienPassword = htmlentities(trim($params['password']));
            $newPassword = htmlentities(trim($params['new-password']));
            $user = $userRepository->getUserByEmail($_SESSION['email']);
            /* var_dump($_SERVER['HTTP_REFERER']);
            exit; */
            if ($user){
                if($ancienPassword !== "" && !password_verify($ancienPassword, $user->getPassword())) {
                    echo "Ancien mot de passe saisie incorrect";
                    exit;
                }
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
                $email = $_SESSION['email'];
                $sql = "UPDATE user SET mdp='$hashedPassword' WHERE email='$email'";
                $userRepository->updateUser($sql);
                echo "success";
            }

        }
    }

    public function updateProfilePhoto($params)
    {
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true){
            $photo = $params['photo'];
            /* var_dump($photo);
            exit; */
            $photoData = null;
            $userRepository = new UserRepository();
            $user = $userRepository->getUserByEmail($_SESSION['email']);
            /* var_dump($_SERVER['HTTP_REFERER']);
            exit; */
            if ($photo !== "null" && $user){
                /* var_dump($photo);
                exit */;
                if ($photo['error'] !== 0) {
                    echo "Une erreur est survenue, veuillez réessayer";
                    exit;
                }
                if ($photo['type'] !== "image/jpeg" && $photo['type'] !== "image/jpg" && $photo['type'] !== "image/png"){
                    echo "Format non autorisé seul jpg, jpeg ou png sont autorisés";
                    exit;
                }
                if($photo["size"] > 500000){
                    echo "Taille photo supérieur à 500kio";
                    exit;
                }
                
                $photoData = file_get_contents($photo["tmp_name"]);
            }
            $email = $_SESSION['email'];
            if (!$userRepository->updateProfilePhoto($email, $photoData)) {
                echo "Une erreur est survenue réessayer";
                exit;
            }
            $_SESSION['photo'] = $photoData;
            echo "success".base64_encode($photoData);
            exit;
        }
    }
}