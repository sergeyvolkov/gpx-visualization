<?php
/**
 * @author  volkov
 * @created 7/1/14 12:44 PM
 */

namespace Application;

use Track;

return function () {
    /**
     * @var Bootstrap $this
     */

    $fileUpload = $this->getRequest()->getFileUpload();
    $file = $fileUpload->getFile('file');

    if ($file) {
        try {
            $track = new Track\Track($file);
            $track->save();

            $this->getMessages()->addSuccess('File has been successfully uploaded');
        } catch (Track\Exception $ex) {
            $this->getMessages()->addError('Error has been occurred');
            $this->getMessages()->addError($ex->getMessage());
        }
    }

    $this->getLayout()->title('Upload track', \Bluz\View\View::POS_PREPEND);
};
