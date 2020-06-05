<?php

namespace admin\helpers;

use admin\models\interfaces\DataExportInterface;

class Export
{
    /**
     * @var $export_type
     */
    private $export_type;

    public function __construct(DataExportInterface $export_type)
    {
        $this->export_type = $export_type;
    }

    public function setExporter(DataExportInterface $export_type)
    {
        $this->export_type = $export_type;
    }

    /**
     * export data
     * 
     * @return mixed
     */
    public function export($data)
    {
        return $this->export_type->export($data);
    }
}