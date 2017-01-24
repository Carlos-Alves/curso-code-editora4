<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Repositories\UserRepository;
use Jrean\UserVerification\Traits\VerifiesUsers;

class UserConfirmationController extends Controller
{
    use VerifiesUsers;
    /**
     * CategoriesController constructor.
     * @param UserRepository $repository
     */
    private $repository;
   public function __construct(UserRepository $repository)
   {
       $this->repository = $repository;
   }

   public function redirectAfterVerification()
   {
       $this->loginUser();
       return route('codeeduuser.user_settings.edit');

   }

   private function loginUser(){
        $email = \Request::get('email');
        $user = $this->repository->findByField('email', $email)->first();
        \Auth::login($user);
   }


}
