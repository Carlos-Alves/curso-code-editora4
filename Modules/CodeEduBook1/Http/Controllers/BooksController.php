<?php

namespace CodeEduBook\Http\Controllers;

use CodeEduBook\Http\Requests\BookCoverRequest;
use CodeEduBook\Models\Book;
use CodeEduBook\Pub\BookCoverUpload;
use CodeEduBook\Repositories\CategoryRepository;
use CodeEduBook\Http\Requests\BookCreateRequest;
use CodeEduBook\Http\Requests\BookUpdateRequest;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Criteria\FindByAuthor;
use Illuminate\Http\Request;
use CodeEduUser\Annotations\Mapping as Permission;


/**
 * @Permission\Controller(name="book-admin", description="Administração de livros")
 *
 */
class BooksController extends Controller
{

    /**
     * @var BookRepository
     */
    protected $repository;
    /**
     * @var \CodeEduBook\Repositories\CategoryRepository
     */
    private $categoryRepository;

    /**
     * @param BookRepository $repository
     * @param CategoryRepository $categoryRepository
     * @internal param BookValidator $
     */


    public function __construct(BookRepository $repository, CategoryRepository $categoryRepository)
    {
        $this->repository = $repository;
        $this->repository->pushCriteria(new FindByAuthor());
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     * @Permission\Action(name="list", description="listar livros")
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->repository->paginate(10);
        return view('codeedubook::books.index', compact('books', 'search'));
    }

    /**
     * create.
     * @Permission\Action(name="store", description="Cadastrar livros")
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        return view('codeedubook::books.create', compact('books', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     * @Permission\Action(name="store", description="Cadastrar livros")
     * @param  BookCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(BookCreateRequest $request)
    {
        $data = $request->all();
        $data['author_id'] = \Auth::user()->id;
        $this->repository->create($data);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro cadastrado com sucesso.');
        return redirect()->to($url);
    }


    /**
     * Show the form for editing the specified resource.
     * @Permission\Action(name="update", description="Atualizar livros")
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');
        return view('codeedubook::books.edit', compact('book', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     * @Permission\Action(name="update", description="Atualizar livros")
     * @param  \CodeEduBook\Http\Requests\BookUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $data = $request->except(['author_id']);
        $data['published'] = $request->get('published', false);
        $this->repository->update($data,$book->id);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro editado com sucesso.');
        return redirect()->to($url);
    }


    /**
     * Remove the specified resource from storage.
     * @Permission\Action(name="destroy", description="Excluir livros")
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
       $this->repository->delete($book->id);
        \Session()->flash('message', 'Livro excluído com sucesso.');
        return redirect()->to(\URL::previous());
    }

    /**
     *
     * @Permission\Action(name="cover", description="Cover livros")
     * @param  Book $book
     * @return \Illuminate\Http\Response
     */
    public function coverForm(Book $book){
        return view('codeedubook::books.cover', compact('book'));
    }

    /**
     * @Permission\Action(name="cover", description="Cover livros")
     */
    public function coverStore(BookCoverRequest $request, Book $book, BookCoverUpload $upload){

        $upload->upload($book, $request->file('file'));
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Cover cadastrado com sucesso.');
        return redirect()->to($url);
    }
}
