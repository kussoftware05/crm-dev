<?php

namespace admin\helpers;

use admin\models\interfaces\DataExportInterface;

class ExportAsJson implements DataExportInterface
{
    /**
     * return data as json
     * 
     * @param array $data
     * @return string
     */
    public function export($data)
    {
        return json_encode($data);
    }
}