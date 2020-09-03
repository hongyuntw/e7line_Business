<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithCalculatedFormulas;
class UserImport implements ToCollection , WithCalculatedFormulas
{
    /**
    * @param Collection $collection
    */
    public $rows = null;

    public function collection(Collection $collection)
    {
        //
        $this->rows = $collection;
    }

    public function getRows()
    {
        return $this->rows;
    }
}
