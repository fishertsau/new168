<?php

namespace App\Http\Controllers\Admin\Device;

use Acme\Tool\Ranker\Ranker;
use App\Models\Occasion;
use Illuminate\Http\Request;
use Acme\Tool\Filterable\Filterable;

/**
 * Class OccasionsController
 * @package App\Http\Controllers\Admin\Device
 */
class OccasionsController extends Filterable
{
    protected $queryTermName = 'occasionQueryTerm';
    protected $defaultQueryTerm = [
        'keyword_by' => 'title',
        'keyword' => '',
        'active' => true
    ];

    protected $paginationView = '';

    /**
     * save the query term reformatted for SQL filter
     * @var array
     */
    protected function modelQueryBuilder()
    {
        $queryTerm = $this->queryTerm();

        return Occasion::
        oldest('rank')->

        keywordBy($queryTerm['keyword_by'],
            $queryTerm['keyword'])->
        active($queryTerm['active']);
    }


    public function index()
    {
        $queryTerm = $this->queryTerm();
        return view('admin.occasion.index', compact('queryTerm'));
    }


    public function create()
    {
        return view('admin.occasion.create');
    }


    public function store(Request $request)
    {
        Occasion::create($request->all());

        flash()->success('您剛剛新增了一筆資料');

        return redirect('admin/occasions');
    }


    public function edit(Occasion $occasion)
    {
        return view('admin.occasion.edit', compact('occasion'));
    }


    public function update(Occasion $occasion, Request $request)
    {
        $occasion->update($request->all());

        flash()->success('您剛剛修改了一筆資料內容');

        return redirect('admin/occasions');
    }


    /**
     * Re-rank occasions
     * @param $rank
     * @param Request $request
     * @return string
     */
    public function reRank($rank, Request $request)
    {
        (new Ranker(Occasion::class, $rank))->handle( $request->input('rankAction'));

        return 'success';
    }
}
