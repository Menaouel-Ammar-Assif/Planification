<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;




class ActionsExport implements FromCollection, WithHeadings, ShouldAutoSize
{

    protected $data;
    protected $direction;

    public function __construct($data, $direction)
    {
        $this->data = $data;
        $this->direction = $direction;
    }

    public function collection()
{
    

    // Use $this->data directly without any additional filtering
    $collection = collect($this->data);
    $direction = collect($this->direction);

    // Map through $direction and filter data accordingly
    $filteredData = $direction->flatMap(function ($dir) use ($collection) 
    {
        // Filter items from $collection where id_dir matches
        $filteredItems = $collection->filter(function ($item) use ($dir) 
        {
            return $dir->id_dir == $item->id_dir;
        })->map(function ($filteredItem) use ($dir) 
        {
            // Transform filtered items
            return 
            [
                'Structure Centrale' => $dir->lib_dir ,
                'lib_act' => $filteredItem->lib_act,
                'dd' => $filteredItem->dd,
                'df' => $filteredItem->df,
                'etat' => $filteredItem->etat ,
            ];
        });

        return $filteredItems;
    });

    return $filteredData;
}
    
    public function headings(): array
    { 

        return 
        [
            'Structure Centrale',
            'Actions',
            'Date Debut',
            'Date Fin',
            'Avencement',          
        ];
    }
}