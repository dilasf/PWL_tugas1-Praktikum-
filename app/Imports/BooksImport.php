<?php

namespace App\Imports;

use App\Models\Book;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class BooksImport implements  WithHeadingRow,ToModel
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Book([
            'title'        => $row['judul'],
            'author'       => $row['penulis'],
            'year'         => $row['tahun'],
            'publisher'    => $row['penerbit'],
            'city'         => $row['kota'],
            'quantity'     => $row['kuantitas'],
            'bookshelf_id' => $row['kode_rak'],
        ]);

        // return new Book([
        //     'title' => $row['title'],
        //     //'title' => trim($row['title']),
        //     'author' => $row['author'],
        //     'year' => $row['year'],
        //     'publisher' => $row['publisher'],
        //     'city' => $row['city'],
        //     'quantity' => $row['quantity'],
        //     'bookshelf_id' => $row['bookshelf_id'],

        // ]);
    }

}
