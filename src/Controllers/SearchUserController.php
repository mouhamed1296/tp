<?php
namespace App\Controllers;
use App\Repositories\UserRepository;

class SearchUserController
{
    public function searchUndrafted($params){
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true){
            $searchTerm = $params['searchTerm'];
            $userRepository = new UserRepository();
            $users = $userRepository->searchUndraftedUsers($searchTerm, $_SESSION['email']) ?? [];
            include_once __DIR__."/../Utils/paginateResults.php";
            $users = $userRepository->paginateSearchUndrafted($searchTerm, $start, $limit, $_SESSION['email']) ?? [];
            if ($_SESSION['role'] === "User")
            {
                $this->showUserTable($users);
                return;
            }
            if ($_SESSION['role'] === "Admin")
            {
                $this->showAdminTableUndrafted($users);
                return;
            }
        } else {
            header('location: /tp/');
        }
    }
    public function searchDrafted($params){
        session_start();
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true){
            $searchTerm = $params['searchTerm'];
            $userRepository = new UserRepository();
            $users = $userRepository->searchDraftedUsers($searchTerm, $_SESSION['email']) ?? [];
            if ($_SESSION['role'] === "User")
            {
                $this->showUserTable($users);
                return;
            }
            if ($_SESSION['role'] === "Admin")
            {
                $this->showAdminTableDrafted($users);
                return;
            }
        } else {
            header('location: /tp/');
        }
    }

    private function showUserTable(array $users): void
    {
        if (count($users) > 0){
            include_once __DIR__."/../Views/components/userTableList.phtml";
        } else {
            include_once __DIR__."/../Views/components/NoUserFound.phtml";
        }
    }

    private function showAdminTableUndrafted(array $users): void
    {
        if (count($users) > 0){
            include_once __DIR__."/../Views/components/adminTableList.phtml";
        } else {
            include_once __DIR__."/../Views/components/NoUserFound.phtml";
        }
    }

    private function showAdminTableDrafted(array $users): void
    {
        if (count($users) > 0){
            include_once __DIR__."/../Views/components/adminTableDraftedList.phtml";
        } else {
            include_once __DIR__."/../Views/components/NoUserFound.phtml";
        }
    }
}