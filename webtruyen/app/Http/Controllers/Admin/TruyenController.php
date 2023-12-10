<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Truyen;
use Illuminate\Http\Request;

class TruyenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title='Danh sách truyện';
        $danhsach=Truyen::orderby('id','ASC')->get();
        return view('admin.truyen.index', compact('title','danhsach'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Truyen $truyen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Truyen $truyen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Truyen $truyen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Truyen $truyen)
    {
        //
    }
}
