<?php
/**
 * @author  volkov
 * @created 7/1/14 4:51 PM
 */

/**
 * @namespace
 */
namespace Track;

class Track {

    const MAX_TRACK_SIZE = '5242880'; // 5Mb
    const PATH_TO_TRACKS = './uploads/tracks/';

    const ALLOWED_EXTENSIONS_GPX = 'gpx';

    protected $file;

    /**
     * @param \Bluz\Http\File $file
     */
    public function __construct($file)
    {
        $this->file = $file;
    }

    static function getAllowedExtensions()
    {
        return [
            self::ALLOWED_EXTENSIONS_GPX,
        ];
    }

    /**
     * @param \Bluz\Http\File $file
     * @return bool
     */
    protected function validateFile()
    {
        return (in_array($this->file->getExtension(), Track::getAllowedExtensions()))
                    && ($this->file->getSize() < Track::MAX_TRACK_SIZE);
    }

    public function save()
    {
        if (!$this->validateFile()) {
            throw new Exception('File is not valid');
        }

        try {
            $fileName = date('Ymd') . '-' . app()->user()->id . '-' . uniqid();
            $filePath = realpath(self::PATH_TO_TRACKS);

            $this->file->setName($fileName);
            $this->file->moveTo($filePath);
        } catch (Exception $ex) {
            throw new Exception('Error during file upload');
        }
    }

}
