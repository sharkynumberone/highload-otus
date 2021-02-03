<?php

namespace App\Http\Controllers;

use App\Services\Factories\FriendFactory;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FriendController
{
    /**
     * @var FriendFactory
     */
    private $friend_factory;

    /**
     * FriendController constructor.
     * @param FriendFactory $friend_factory
     */
    public function __construct(FriendFactory $friend_factory)
    {
        $this->friend_factory = $friend_factory;
    }

    /**
     * @param Request $request
     * @return Application|Factory|View
     */
    public function list(Request $request)
    {
        $user_service = $this->friend_factory->createUserService();
        $current_user_id = $user_service->getCurrentUserId();

        $friends_repository = $this->friend_factory->createFriendRepository();

        $friends_raw = $friends_repository->getAll($current_user_id);
        $friends = json_decode(json_encode($friends_raw), true);

        return view('pages.friends')->with(compact('friends'));
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function addToFriendsList(Request $request, int $id)
    {
        $user_service = $this->friend_factory->createUserService();
        $current_user_id = $user_service->getCurrentUserId();

        $friends_repository = $this->friend_factory->createFriendRepository();

        if (!$friends_repository->isAddedToList($current_user_id, $id)) {
            $friends_repository->addToList($current_user_id, $id);
        }

        return redirect()->back();
    }

    /**
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function removeFromFriendsList(Request $request, int $id)
    {
        $user_service = $this->friend_factory->createUserService();
        $current_user_id = $user_service->getCurrentUserId();

        $friends_repository = $this->friend_factory->createFriendRepository();

        if ($friends_repository->isAddedToList($current_user_id, $id)) {
            $friends_repository->removeFromList($current_user_id, $id);
        }

        return redirect()->back();
    }

}
