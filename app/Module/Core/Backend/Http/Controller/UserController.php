<?php

namespace Northstyle\Module\Core\Backend\Http\Controller;

use Illuminate\Http\Request;
use Northstyle\Http\Controllers\Controller;

use Northstyle\Module\Core\Model\User as UserModel;
use Northstyle\Module\Core\Repository\User as UserRepository;

use Northstyle\Module\Core\Backend\Http\Request\UpdateUserRequest;
use Northstyle\Module\Core\Backend\Http\Request\StoreUserRequest;
use Northstyle\Module\Core\Backend\Http\Request\DeleteUserRequest;

class UserController extends Controller
{
	protected $base = 'backend.core.user.';

	protected $repository;

    /**
     *
     * BlogController constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
		$this->repository = $userRepository;
		$this->createUserBehavior = \App::make('core.behavior.createUser');
		$this->updateUserBehavior = \App::make('core.behavior.updateUser');
		$this->removeUserBehavior = \App::make('core.behavior.removeUser');

		\View::share('base', $this->base);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->findAll();

		$paginate = new \Illuminate\Pagination\LengthAwarePaginator($users, $this->repository->countAll(), 10);
		$paginate->setPath(route($this->base . 'index'));

        return view($this->base . 'index', compact('users', 'paginate'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
		$user = $this->repository->getBuilder()->build();

        return view($this->base . 'form',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
		$this->createUserBehavior->handle($request);

		return redirect(route($this->base . 'index'))->with('status','Потребителят е създаден!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
		$user = $this->repository->findOneById($id);

        return view($this->base . 'form',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
		$this->updateUserBehavior->handle($request);

        return redirect(route($this->base . 'edit', $request->id))->with('status', 'Потребителят е запазен!');
	}

    public function confirm_delete(DeleteUserRequest $request, $id) {
		$user = $this->repository->findOneById($request->id);

        return view($this->base . 'confirm',compact('user'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeleteUserRequest $request, $id)
    {
		$this->removeUserBehavior->handle($request);

        return redirect(route($this->base . 'index'))->with('status', 'Потребителят е изтрит!');
    }
}
