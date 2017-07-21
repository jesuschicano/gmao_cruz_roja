<?php
Route::get('/', function () {
    return redirect('/home');
});

/** BLOQUE AUTENTIFICACION **/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
/** END BLOQUE AUTENTIFICACION **/

/** BLOQUE PROVEEDORES **/
/* LISTAR */
Route::get('proveedores', 'ProveedoresController@getIndex');
/* INSERTAR */
Route::get('proveedores/insert', 'ProveedoresController@insertForm');
Route::post('proveedores/add', 'ProveedoresController@insert');
/* BORRAR */
Route::get('proveedores/borrar/{id}', 'ProveedoresController@borra');
/* MODIFICAR */
Route::get('proveedores/editar/{id}','ProveedoresController@preEdit');
Route::post('proveedores/editar/{id}','ProveedoresController@editar');
/** END BLOQUE PROVEEDORES **/