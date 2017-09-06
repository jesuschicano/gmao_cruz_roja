<?php
Route::get('/', function () {
    return redirect('/home');
});


/** BLOQUE AUTENTIFICACION **/
/*******/
Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
/** END BLOQUE AUTENTIFICACION **/

/** BLOQUE PROVEEDORES **/
/************************/
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

/** BLOQUE DE MOTIVOS DE BAJA **/
/*******************************/
/* LISTAR */
Route::get('motivos', 'MotivosController@index');
/* INSERTAR */
Route::get('motivos/create', 'MotivosController@create');
Route::post('motivos/store', 'MotivosController@store');
/* EDITAR */
Route::get('motivos/edit/{id}', 'MotivosController@edit');
Route::post('motivos/update/{id}', 'MotivosController@update');
/* BORRAR */
Route::get('motivos/destroy/{id}', 'MotivosController@destroy');
/*******************************/

/** BLOQUE DE PERIODICIDADES **/
/******************************/
/* LISTAR */
Route::get('periodicidades', 'PeriodicidadesController@index');
/* INSERTAR */
Route::get('periodicidades/create', 'PeriodicidadesController@create');
Route::post('periodicidades/store', 'PeriodicidadesController@store');
/* EDITAR */
Route::get('periodicidades/edit/{id}', 'PeriodicidadesController@edit');
Route::post('periodicidades/update/{id}', 'PeriodicidadesController@update');
/* BORRAR */
Route::get('periodicidades/destroy/{id}', 'PeriodicidadesController@destroy');
/******************************/

/** BLOQUE INVENTARIO **/
/***********************/
/* LISTAR */
Route::get('inventario/old', 'InventarioController@getIndexOld');
Route::get('inventario', 'InventarioController@getIndex');
/* INSERTAR */
Route::get('inventario/create', 'InventarioController@create');
Route::post('inventario/store', 'InventarioController@store');
/* EDITAR */
Route::get('inventario/edit/{id}', 'InventarioController@edit');
Route::post('inventario/update/{id}', 'InventarioController@update');
/* BORRAR */
Route::get('inventario/destroy/{id}', 'InventarioController@destroy');
/** END BLOQUE INVENTARIO **/

/** BLOQUE REVISIONES **/
/***********************/
/* LISTAR LAS REVISIONES POR ITEM */
Route::get('revisiones/{id}', 'RevisionController@getIndex');
Route::get('revisiones', 'RevisionController@listAll');
/* INSERTAR */
Route::get('revisiones/create/{id}', 'RevisionController@create');
Route::post('revisiones/save/{id}', 'RevisionController@save');
/* EDITAR */
Route::get('revisiones/edit/{id}', 'RevisionController@edit');
Route::post('revisiones/update/{id}', 'RevisionController@update');
/* BORRAR */
Route::get('revisiones/destroy/{id}', 'RevisionController@destroy');

Route::get('revisiones/download/', 'RevisionController@download');
/** END BLOQUE REVISIONES **/

/** BLOQUE DE INFORMES **/
/************************/
/* LISTAR LOS ENLACES A LAS REVISIONES */
Route::get('informes', 'PDFController@index');
Route::get('informes/revisiones', 'PDFController@crearInformeTodasRevisiones');
/** END BLOQUE DE INFORMES **/

/** BLOQUE FICHEROS **/
Route::get('subida/{id}', 'ArchivosController@create');
Route::post('subida/store/{id}', 'ArchivosController@store');
Route::get('ficheros/index', 'ArchivosController@index');
Route::get('ficheros/get/{filename}', 'ArchivosController@get');
/** END BLOQUE FICHEROS **/

Route::get('/send','SendController@mandarAviso');
