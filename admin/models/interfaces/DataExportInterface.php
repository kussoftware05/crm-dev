<?php

namespace admin\models\interfaces;

interface DataExportInterface
{
    /**
     * export data of any kind
     * @param array $data
     */
    public function export($data);
}