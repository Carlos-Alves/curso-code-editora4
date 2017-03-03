<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Criteria\FindPermissionsGroupCriteria;
use CodeEduUser\Criteria\FindPermissionsResourceCriteria;
use CodeEduUser\Http\Requests\PermissionRequest;
use CodeEduUser\Http\Requests\RoleDeleteRequest;
use CodeEduUser\Http\Requests\RoleRequest;
use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Repositories\RoleRepository;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use CodeEduUser\Annotations\Mapping as Permission;
//use Illuminate\Routing\Controller;

/**
 * @Permission\Controller(name="role-admin", description="Administração de papéis de usuários")
 *
 */
class RolesController extends Controller
{
    /**
     * @var RoleRepository
     */
    private $repository;
    /**
     * @var PermissionRepository
     */
    private $permissionRepository;

    /**
     * RolesController constructor.
     * @var \CodeEduUser\Repositories\RoleRepository $repository
     * @param PermissionRepository $permissionRepository
     */
    public function __construct(RoleRepository $repository, PermissionRepository $permissionRepository)
    {
        $this->repository = $repository;
        $this->permissionRepository = $permissionRepository;
    }


    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="Listar papéis de usuário")
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->repository->paginate(10);
        return view('codeeduuser::roles.index', compact('roles'));
    }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="store", description="Cadastrar papéis de usuário")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::roles.create');
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Cadastrar papéis de usuário")
     * @param  Request $request
     * @return Response
     */
    public function store(RoleRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Papel usuário cadastrada com sucesso.');
        return redirect()->to($url);
    }


    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar papéis de usuário")
     * @return Response
     */
    public function edit($id)
    {
        $role = $this->repository->find($id);
        return view('codeeduuser::roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar papéis de usuário")
     * @param  Request $request
     * @return Response
     */
    public function update(RoleRequest $request, $id)
    {
        $data = $request->except('permissions');
        $this->repository->update($data,$id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Papel de usuário editado com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir papéis de usuário")
     * @return Response
     */
    public function destroy(RoleDeleteRequest $request, $id)
    {
        try{
            $this->repository->delete($id);
            \Session()->flash('message', 'Papel de usuário excluído com sucesso.');
        }catch (QueryException $ex){
            \Session()->flash('error', 'Papel de usuário não pode ser excluído. Ele está relacionado com outros registros');
        }
        return redirect()->to(\URL::previous());
    }

    public function editPermission($id){
        $role = $this->repository->find($id);
        $this->permissionRepository->pushCriteria(new FindPermissionsResourceCriteria());
        $permissions = $this->permissionRepository->all();

        $this->permissionRepository->resetCriteria();
        $this->permissionRepository->pushCriteria(new FindPermissionsGroupCriteria());
        $permissionsGroup = $this->permissionRepository->all(['name', 'description']);

        return view('codeeduuser::roles.permissions', compact('role', 'permissions', 'permissionsGroup'));
    }

    public function updatePermission(PermissionRequest $request,$id){
        $data = $request->get('permissions', []);
        $this->repository->updatePermissions($data,$id);
        $url = $request->get('redirect_to', route('codeeduuser.roles.index'));
        $request->session()->flash('message', 'Permissões atribuídas com sucesso.');
        return redirect()->to($url);

    }
}
