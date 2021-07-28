<?php

return [

    /*
     * max lease day
     */
    'max_lease_day' => 12,

    /*
     * user roles
     */
    'roles' => [
        1 => 'customer',
        2 => 'employee'
    ],

    /*
     * lease statuses
     */
    'statuses' => [
        1 => 'waiting',
        2 => 'delivered',
        3 => 'returned'
    ],

    /*
     * title list for product owner
     */
    'owner_title_list' => [
        1 => 'Author',
        2 => 'Interpret',
        3 => 'Development Studio',
    ],

    /*
     * alert types for Alert component
     */
    'alert_types'   => [
        'primary'   => 'alert-primary',
        'secondary' => 'alert-secondary',
        'success'   => 'alert-success',
        'danger'    => 'alert-danger',
        'warning'   => 'alert-warning',
        'info'      => 'alert-info',
        'light'     => 'alert-light',
        'dark'      => 'alert-dark',
    ],

];
