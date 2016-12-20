<?php

namespace CodEditora\Http\Controllers;


use CodEditora\Criteria\FindByAuthorCriteria;
use CodEditora\Criteria\FindByCategoryCriteria;
use CodEditora\Criteria\FindByTitleCriteria;
use CodEditora\Repositories\CategoryRepository;
use Illuminate\Http\Request;

use CodEditora\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use CodEditora\Http\Requests\BookCreateRequest;
use CodEditora\Http\Requests\BookUpdateRequest;
use CodEditora\Repositories\BookRepository;



class BooksController extends Controller
{

    /**
     * @var BookRepository
     */
    protected $repository;
    /**
     * @var CategoryRepository
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
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->get('search');
        $books = $this->repository->paginate(10);
        return view('books.index', compact('books', 'search'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->lists('name', 'id');
        return view('books.create', compact('books', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = $this->repository->find($id);
        $this->categoryRepository->withTrashed();
        $categories = $this->categoryRepository->listsWithMutators('name_trashed', 'id');
        return view('books.edit', compact('book', 'categories'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  BookUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $data = $request->except(['author_id']);
        $this->repository->update($data,$id);
        $url = $request->get('redirect_to', route('books.index'));
        $request->session()->flash('message', 'Livro editado com sucesso.');
        return redirect()->to($url);
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $this->repository->delete($id);
        \Session()->flash('message', 'Livro excluído com sucesso.');
        return redirect()->to(\URL::previous());
    }
}
