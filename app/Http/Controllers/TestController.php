<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index(Request $request)
    {

        $otm = '';
        if($request->otm){
            if($request->otm == 'TATU'){
                $otm = 'Toshkent Axborot Texnologiyalari Universiteti';
            } else if($request->otm == 'yodju'){
                $otm = 'Toshkent shahar Yodju instituti';
            } else {
                $otm = 'Qaysidur instituda';
            }
        }
        return view('test', ['nom' => $request->name, 'lastname' => $request->lastname, 'univercity' => $otm]);
        // return view('test', compact('nom', 'lastname'));
    }

    public function create()
    {
        // date_timezone_set('Asia/Tashkent', +5);
        // $user = new User();
        // $user->name = 'Farrukh';
        // $user->email = 'choriyevfarrux@mail.ru';
        // $user->password = '12345678';
        // $user->save();

        // $product = new Product();
        // $product->name = 'olma';
        // $product->save();

        $cat = new Category();
        $cat->name = 'meva';
        $cat->quantity = 12;
        $cat->save();


        // name string
        //brand string
        /// type string
        //price float

        echo 'success category';
    }
}
