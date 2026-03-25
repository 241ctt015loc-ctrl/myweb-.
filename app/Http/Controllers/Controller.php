<?php

namespace App\Http\Controllers;

abstract class Controller
{
     public function index() {
        $comics = [
            (object)[
                'name' => 'One Piece',
                'price' => 50000,
                'image' => 'https://via.placeholder.com/200x250'
            ],
            (object)[
                'name' => 'Naruto',
                'price' => 45000,
                'image' => 'https://via.placeholder.com/200x250'
            ],
            (object)[
                'name' => 'Attack on Titan',
                'price' => 60000,
                'image' => 'https://via.placeholder.com/200x250'
            ],
        ];

        return view('home', compact('comics'));
    }
}
