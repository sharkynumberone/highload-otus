<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;
use App\Services\Factories\UserFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    /**
     * @var UserFactory
     */
    private $user_factory;

    /**
     * UserController constructor.
     * @param UserFactory $user_factory
     */
    public function __construct(UserFactory $user_factory)
    {
        $this->user_factory = $user_factory;
    }

    /**
     * @param Request $request
     * @return Application|RedirectResponse|Redirector
     */
    public function showRegister(Request $request)
    {
        $user_service = $this->user_factory->createUserService();
        $user_id = $user_service->getCurrentUserId();

        if ($user_id) {
            return redirect('/');
        }

        return view('pages.register');
    }

    /**
     * @param UserRegisterRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function register(UserRegisterRequest $request)
    {
        $valid_data = $request->validated();
        $user_service = $this->user_factory->createUserService();
        $user_repository = $this->user_factory->createUserRepository();

        $register_user = $user_service->prepareRegisterData($valid_data);

        $user_repository->create($register_user);
        $user_raw = $user_repository->findByEmail($register_user->getEmail());
        $user = json_decode(json_encode($user_raw[0]), true);

        $user_service->authorize($user['id']);

        return redirect('/profile');
    }

    public function showUsers(Request $request)
    {
        $user_service = $this->user_factory->createUserService();
        $user_repository = $this->user_factory->createUserRepository();

        $user_id = $user_service->getCurrentUserId();
        $user_raw = $user_repository->getAllWithoutCurrentUser($user_id);
        $users = json_decode(json_encode($user_raw), true);

        return view('pages.users')->with(compact('users'));
    }

    public function search(Request $request)
    {
        $user_repository = $this->user_factory->createUserRepository();

        $search = $request->input('search_string');

        $name_surname = explode(' ', $search);

        $user_raw = $user_repository->findByFirstNameAndLastName($name_surname[0], $name_surname[1]);
        $users = json_decode(json_encode($user_raw), true);

        return view('pages.users_search')->with(compact('users'));
    }

    /**
     * @param UserLoginRequest $request
     * @return Application|RedirectResponse|Redirector
     */
    public function authorization(UserLoginRequest $request)
    {
        $valid_data = $request->validated();

        $user_service = $this->user_factory->createUserService();
        $user_repository = $this->user_factory->createUserRepository();

        $user_raw = $user_repository->findByEmail($valid_data['email']);

        if (empty($user_raw)){
            return redirect()->back()
                ->withErrors(['Пользователя с таким email не существует'])
                ->withInput();
        } else{
            $user = json_decode(json_encode($user_raw[0]), true);
            $correct_credentials = $user_service->checkAuthorize($valid_data['password'], $user['password'], $user['salt']);

            if ($correct_credentials) {
                $user_service->authorize($user['id']);
                return redirect('/profile');
            } else {
                return redirect()->back()
                    ->withErrors(['Пароль некорректен'])
                    ->withInput();
            }
        }
    }

    /**
     * @return Application|Factory|View
     */
    public function showProfile()
    {
        $user_service = $this->user_factory->createUserService();
        $user_repository = $this->user_factory->createUserRepository();

        $user_id = $user_service->getCurrentUserId();
        $user_raw = $user_repository->findByUserId($user_id);
        $user = json_decode(json_encode($user_raw[0]), true);

        return view('pages.profile')->with(compact('user'));
    }
}
