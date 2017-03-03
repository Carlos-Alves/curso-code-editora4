<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Http\Requests\CategoryRequest;
use CodeEduBook\Repositories\CategoryRepository;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;

/**
 * @Permission\Controller(name="category-admin", description="Administração de categorias")
 *
 */
class CategoriesController extends Controller
{
    /**
     * CategoriesController constructor.
     * @param CategoryRepository $repository
     */
    private $repository;
   public function __construct(CategoryRepository $repository)
   {
       $this->repository = $repository;
   }

    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="listar categorias")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $categories = $this->repository->paginate(10);
        //$categories = Category::onlyTrashed()->paginate(10);
        return view('codeedubook::categories.index', compact('categories','search'));
    }

    /**
     * Show the form for creating a new resource.
     * @Permission\Action(name="store", description="Cadastrar categorias")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeedubook::categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Cadastrar categorias")
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());
        //Category::create($request->all());
        $url = $request->get('redirect_to', route('categories.index'));
        $request->session()->flash('message', 'Categoria cadastrada com sucesso.');
        return redirect()->to($url);
    }


    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar categorias")
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->repository->find($id);
       return view('codeedubook::categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar categorias")
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $this->repository->update($request->all(),$id);
        $url = $request->get('redirect_to', route('categories.index'));
        $request->session()->flash('message', 'Categoria editada com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir categorias")
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->repository->delete($id);
        \Session()->flash('message', 'Categoria excluída com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
