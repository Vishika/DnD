<?php

namespace App\Http\Controllers;

use App\Enchantment;

class EnchantmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $enchantments = Enchantment::all();
        return view('enchantment.index', compact('enchantments'));
    }
}