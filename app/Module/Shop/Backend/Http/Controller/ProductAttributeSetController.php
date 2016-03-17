<?php
 
namespace Northstyle\Module\Shop\Backend\Http\Controller;

use Illuminate\Http\Request;
use Northstyle\Http\Controllers\Controller;

class ProductAttributeSetController extends Controller
{
	protected $base = 'backend.shop.product.';

	protected $repository;

	public function __construct(AttributeSetRepository $repository) {
		$this->repository = $repository;

		\View::share('base', $this->base);
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->repository->findAll();

		$paginate = new \Illuminate\Pagination\LengthAwarePaginator($products, $this->repository->countAll(), 10);
		$paginate->setPath(route($this->base . 'index'));

        return view($this->base . 'index', compact('products', 'paginate'));
    }

	public function create() {
		$product = $this->repository->getBuilder()->build();

        return view($this->base . 'form',compact('product'));
	}

	public function store(StoreProductRequest $request) {
		$this->dispatchFrom(new CreateAttributeSetBehavior(), $request);

		return redirect(route($this->base . 'index'))->with('status','Продуктът е създаден!');
	}
}
