 <?php

    $router->get('', 'PagesController@home');
    $router->get('consigna', 'PagesController@about');
    $router->get('contact', 'PagesController@contact');


    $router->get('turnos', 'TurnoController@index');
    $router->get('turnos/create', 'TurnoController@create');
    $router->post('turnos/validate', 'TurnoController@validate');
    $router->post('turnos/validateUpdate', 'TurnoController@validateUpdate');
    $router->get('turnos/completo', 'TurnoController@turnoCompleto');
    $router->get('turnos/update', 'TurnoController@update');
    $router->get('turnos/delete', 'TurnoController@delete');
    
    

    $router->get('not_found', 'ProjectController@notFound');
    $router->get('internal_error', 'ProjectController@internalError');
