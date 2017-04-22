<?php

namespace App\Http\Controllers;

use App;
use Exception;
use Illuminate\Http\Request;
use App\Exceptions\NoFileGivenException;
use App\Repository\PhotoRepository;

/**
 * Class PhotoController
 * @package App\Http\Controllers
 */
class PhotoController extends Controller
{
    private $photoRepository;

    /**
     * PhotoController constructor.
     * @param $photoRepository
     */
    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    /**
     * @param $modelName
     * @param $id
     * @param Request $request
     * @param null $field
     * @param null $dir
     * @return \Acme\Tool\Photoable\Photo
     * @throws NoFileGivenException
     * @throws \App\Exceptions\PhotoableNotAllowedException
     */
    public function store($modelName, $id, Request $request, $field = null, $dir = null)
    {
        $file = $request->file('photofile');

        if (!$file) {
            throw new NoFileGivenException();
        }

        try {
            $model = App::make($modelName);
        } catch (Exception $e) {
            return $e->getMessage();
        }

        $modelEntry = $model->whereId($id)->first();

        return $this->photoRepository->storeOrUpdate($file, $modelEntry, $field, $dir);
    }


    public function delete($filepath = null)
    {
        if (!$filepath) {
            throw new Exception('No filepath is give for photo');
        }

        $filepath = !is_array($filepath) ? collect([$filepath]) :
            collect($filepath);

        $filepath->each(function ($item) {
            $this->photoRepository->delete($item);
        });

        return (string)true;
    }
}