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
    protected $path;

    protected $data;

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
            $this->path = $filePath . DIRECTORY_SEPARATOR . $fileName . '.' . $this->file->getExtension();

            $this->file->setName($fileName);
            $this->file->moveTo($filePath);
        } catch (Exception $ex) {
            throw new Exception('Error during file upload');
        }
    }

    public function parse()
    {
        $data = simplexml_load_file($this->path);
        $result = [];

        $result['info'] = [
            'userId'    =>  (int)app()->user()->id,
            'creator'   =>  (string)$data['creator'],
            'time'      =>  (string)$data->{'metadata'}->{'time'},
            'hash'      =>  md5_file($this->path),
        ];

        $points = (array)$data->{'trk'}->{'trkseg'};
        $points = $points['trkpt'];

        foreach ($points as $point) {
            /**
             * @var \SimpleXMLElement $point
             */
            $result['points'] = [
                'latitude'  =>  (float)$point['lat'],
                'longitude' =>  (float)$point['lon'],
                'altitude'  =>  (float)$point->ele,
                'datetime'  =>  (string)$point->time,
            ];
        }

        return $result;
    }

}
