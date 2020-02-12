<?php
Router::register('/', 'userController.show');
Router::register('update/{name}', 'userController.update');
Router::register('all', 'userController.showall');