<?php

use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;


function mockRequest($input = [])
{
    $request = new Request();
    $request->replace($input);

    return $request;
}

/**
 * @param array $input
 * @return Request
 */
function fakeRequest($input = [])
{
    $request = new Request();
    $request->replace($input);

    return $request;
}





function fakeUploadedFile()
{
    return new UploadedFile(
        storage_path('app\test.jpg'),
        'test.jpg', null, null, null, true
    );
}

function fake2ndUploadedFile()
{
    return new UploadedFile(
        storage_path('app\test2.jpg'),
        'test2.jpg', null, null, null, true
    );
}

function mimicUploadedFile($filepath = null,$filename)
{
    return new UploadedFile(
        storage_path($filepath),
        $filename, null, null, null, true
    );
}

function app_storagePath($filepath)
{
    return public_path() . $filepath;
}


function makeCopy($originalFile, $newFile)
{
    File::copy(storage_path($originalFile), storage_path($newFile));
}

function mapAttribute($collection, $field = 'id')
{
    $collection = collect($collection);

    return
        $collection->map(function ($item) use ($field) {
            return $item->{$field};
        })->toArray();
}
