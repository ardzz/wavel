<?php

use Ardzz\Wavel\Cores\Handler\File;

$file = new File(  __DIR__ . '/sample_file');





it('can get file', function () use ($file){
    expect($file->getFile())->toBe(__DIR__ . '/sample_file');
});

it('can read file', function () use ($file){
    expect($file->read())->toBe("testCase");
});

it('can check that file is exists or not', function () use ($file){
    expect($file->exist())->toBeTrue();
});

it('can get mime type of file', function () use ($file){
    expect($file->getMimeType())->toBe('text/plain');
});

it('can identify that file is image or not', function () use ($file){
    expect($file->isImage())->toBeFalse();
});

it('can convert file into base64', function () use ($file){
    expect($file->base64())->toBe(base64_encode($file->read()));
});
