<?php namespace App\Services;

use App\Repositories\UserRepository;

class UserService {
  private UserRepository $userRepository;

  public function __construct(){
    $this->userRepository = new UserRepository();
  }

  public function findById(int $id) {
    $user = $this->userRepository->findById($id);
    return $user;
  }

  public function findMany() {
    $users = $this->userRepository->findMany();
    return $users;
  }

  public function searchByName(string $name) {
    $users = $this->userRepository->searchByName($name);
    return $users;
  }
}
