<?php

// Convert module settings to JSON
  $query = $database->query(
    "select * from ". DB_TABLE_SETTINGS ."
    where (
         `key` = 'store_template_catalog_settings'
         `key` like = 'customer_module_%'
      or `key` like = 'job_module_%'
      or `key` like = 'shipping_module_%'
      or `key` like = 'payment_module_%'
      or `key` like = 'order_action_module_%'
      or `key` like = 'order_success_module_%'
      or `key` like = 'order_total_module_%'
    )"
  );
  while($row = $database->fetch($query)) {
    $new_key = preg_replace('#^((customer|job|shipping|payment|order_action|order_success|order_total)_module_)#', '', $row['key']);
    $new_value = unserialize($row['value']);
    $database->query(
      "update * from ". DB_TABLE_SETTINGS ."
      set `key` = '". $database->input($new_key) ."', value = '". $database->input($new_value) ."'
      where `key` = '". database::input($row['key']) ."%'
      limit 1;"
    );
  }

?>