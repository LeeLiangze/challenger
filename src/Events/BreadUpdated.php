<?php

namespace CHG\Voyager\Events;

use Illuminate\Queue\SerializesModels;
use CHG\Voyager\Models\DataType;

class BreadUpdated
{
    use SerializesModels;

    public $dataType;

    public $data;

    public function __construct(DataType $dataType, $data)
    {
        $this->dataType = $dataType;

        $this->data = $data;

        event(new BreadChanged($dataType, $data, 'Updated'));
    }
}
