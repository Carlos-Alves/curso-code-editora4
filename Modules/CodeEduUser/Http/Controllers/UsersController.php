<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\UserRepository;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    /**
     * CategoriesController constructor.
     * @param UserRepository $repository
     */
    private $repository;
   public function __construct(UserRepository $repository)
   {
       $this->repository = $repository;
   }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $users = $this->repository->paginate(10);
        //$users = User::onlyTrashed()->paginate(10);
        return view('codeeduuser::users.index', compact('users','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->repository->create($request->all());
        //User::create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'usuário cadastrada com sucesso.');
        return redirect()->to($url);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->find($id);
       return view('codeeduuser::users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $data = $request->except(['password']);
        $this->repository->update($request->all(),$id);
        $url = $request->get('redirect_to', route('codeeduuser.users.index'));
        $request->session()->flash('message', 'Usuário editado com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session()->flash('message', 'Usuário excluído com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
