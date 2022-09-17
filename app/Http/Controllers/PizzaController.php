<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Http\Request;
use App\Models\Pizza;



class PizzaController extends Controller
{   
    public function __construct(){
        $this->middleware('auth')->except(['create','store']);
    }
    //
    public function index(){
        $pizzas = Pizza::latest()->get();
        return view('pizza.index',["pizzas"=>$pizzas]);
    }
    public function show($id){
        $pizza = Pizza::find($id);
        return view ("pizza.show",["pizza"=>$pizza]);
    }
    public function create(){
        return view("pizza.create");
    }
    public function store(){
        $pizza = new Pizza();
        $pizza->name = request("name");
        $pizza->base = request("base");
        $pizza->type = request("type");
        $pizza->toppings = request("toppings");
        $pizza->save();
        Session::flash("message","Pizza added");

        return redirect("/pizzas");
    }
    public function destroy($id){
       $pizza = Pizza::find($id);
       $pizza->delete();
       Session::flash("message","Pizza deleted");
       return redirect("/pizzas");
    }
    public function edit($id){
        $pizza = Pizza::findOrFail($id);
        return view("pizza.edit",["pizza"=>$pizza]);
    }
    public function update($id){
        $pizza = Pizza::find($id);
        $pizza->name = request("name");
        $pizza->base = request("base");
        $pizza->type = request("type");
        $pizza->save();

        Session::flash("message","Pizza updated");
        return redirect("/pizzas");
    }
    
}
