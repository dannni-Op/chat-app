<?php namespace App\Services;

use App\Repositories\SessionRepository;
use App\Models\SessionModel;

class SessionService {
    private static string $COOKIE_NAME = "ibuku-cantik";
    private SessionRepository $sessionRepository;

    public function __construct(){
        $this->sessionRepository = new SessionRepository();
    }

    public function create(int $userId): bool {
        $session = new SessionModel();
        $session->id = uniqid();
        $session->userId = $userId;

        $this->sessionRepository->save($session);
        setcookie(self::$COOKIE_NAME, $session->id, time() + (60 * 60 * 24 * 7), "/");
        return true;
    }
    
    //logout perlu perbaikan
    public function current(): ?SessionModel {
        $id = $_COOKIE[self::$COOKIE_NAME] ?? '';
        if( $id ){
            $session = $this->sessionRepository->findById($id);
            return $session;
        }

        return null;
    }

    public function destroy(){
        $id = $_COOKIE[self::$COOKIE_NAME] ?? '';
        if( $id ) {
            $this->sessionRepository->delete($id);
            setcookie(self::$COOKIE_NAME, '', -1, '/');
        }
    }
}
