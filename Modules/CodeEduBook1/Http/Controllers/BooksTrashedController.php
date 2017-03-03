<?php

namespace CodeEduBook\Http\Controllers;


use Illuminate\Http\Request;
use CodeEduBook\Repositories\BookRepository;
use CodeEduUser\Annotations\Mapping as Permission;



/**
 * @Permission\Controller(name="book-trashed-admin", description="Administração de livros excluídos")
 *
 */
class BooksTrashedController extends Controller
{

    /**
     * @var BookRepository
     */
    protected $repository;

    public function __construct(BookRepository $repository)
    {
        $this->repository = $repository;
    }


    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="listar livros excluídos")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->repository->onlyTrashed()->paginate(10);
        return view('codeedubook::trashed.books.index', compact('books', 'search'));
    }

    /**
     * @Permission\Action(name="list", description="listar livro excluído")
     */
    public function show($id)
    {
        $this->repository->onlyTrashed();
        $book = $this->repository->find($id);
        return view('codeedubook::trashed.books.show', compact('book'));
    }

    /**
     * @Permission\Action(name="restore", description="Restaurar livro excluído")
     */
    public function update(Request $request, $id)
    {
        $this->repository->onlyTrashed();
        $this->repository->restore($id);

        $url = $request->get('redirect_to', route('trashed.books.index'));
        $request->session()->flash('message', 'Livro restaurado com sucesso.');
        return redirect()->to($url);
    }



}
