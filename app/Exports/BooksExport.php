<?php

namespace App\Exports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\withHeading;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class BooksExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Book::all();
    }

    public function array(): array
    {
        return Book::getDataBooks();
    }
    public function headings(): array
    {
        return [
            // 'No',
            // 'Judul',
            // 'Penulis',
            // 'Tahun',
            // 'Penerbit'
            'No',
            'title',
            'author',
            'year',
            'publisher'

        ];
    }
}
