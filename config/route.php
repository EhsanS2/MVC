<?php
Router::register('/', 'userController.show');
Router::register('update/{name}', 'userController.update');