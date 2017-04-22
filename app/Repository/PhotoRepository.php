<?php


namespace App\Repository;


use Acme\Tool\Photoable\Photo;
use Acme\Tool\Photoable\Photoable;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\HttpFoundation\File\File;
use App\Exceptions\PhotoableNotAllowedException;


/**
 * Class PhotoRepository
 * @package Acme\Tool\Photoable
 */
class PhotoRepository
{
    /**
     * @param UploadedFile|File $file
     * @param Model $model
     * @param null $field
     * @param null $dir : will use (1)model's photoDir, (2)Photo default dir  if not specified
     * @return Photo $photo
     * @throws PhotoableNotAllowedException
     */
    public function storeOrUpdate(UploadedFile $file, Photoable $model, $field = null, $dir = null)
    {
        if (!$this->photoable($model)) {
            throw new PhotoableNotAllowedException('Only model with photoable ability could be proceeded');
        }

        if ($field) {
            return (!$photo = $model->getFieldPhoto($field)) ?
                $this->store($file, $model, $field, $dir) :
                $this->update($file, $model, $photo, $dir);
        }

        return $this->store($file, $model, null, $dir);
    }

    /**
     * @param $filepath
     * @return mixed
     */
    public function getByFilepath($filepath)
    {
        return Photo::whereFilepath($filepath)->first();
    }


    public function delete($filepath)
    {
        //Should we protect against if null photo is found?

        return $this->getByFilepath($filepath)->delete();
    }


    private function store(UploadedFile $file, Photoable $model, $field = null, $dir = null)
    {
        $filePath = $this->storePhotoFile($file, $model, $dir);
        return $this->createPhoto($model, $filePath, $field);
    }


    /**
     * @param UploadedFile $file
     * @param Model $model
     * @param null $dir
     * @return string
     */
    private function storePhotoFile(UploadedFile $file, Photoable $model, $dir = null)
    {
        if (!$dir) {
            $dir = (!$model->getPhotoDir()) ? Photo::dirDefault : $model->getPhotoDir();
        }

        $newFileName = $this->generateNewFilename($file);
        $storageDir = $this->storageDirectory($dir);
        $file->move($storageDir, $newFileName);

        $filepath = $this->fileDirectory($dir) . '/' . $newFileName;

        return $filepath;
    }


    private function fileDirectory($dir)
    {
        return Photo::baseDirectory .$dir;
    }


    private function storageDirectory($dir)
    {
        return public_path() . Photo::baseDirectory . '/' . $dir;
    }


    private function generateNewFilename(UploadedFile $file)
    {
        return time() . md5($file->getClientOriginalName()) . '.' . $file->getClientOriginalExtension();
    }


    private function createPhoto(Model $model, $filePath = null, $field = null)
    {
        return $model->photos()->create([
                'filepath' => $filePath,
                'field' => $field,
            ]
        );
    }



    private function update(UploadedFile $file, Photoable $model, Photo $photo, $dir = null)
    {
        $filepath = $this->storePhotoFile($file, $model, $dir);
        $photo->update(['filepath' => $filepath]);

        return $photo->fresh();
    }


    private function photoable(Photoable $model)
    {
        return method_exists($model, 'photos');
    }
}