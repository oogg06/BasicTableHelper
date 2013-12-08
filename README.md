BasicTableHelper
================

A very basic Helper for CakePHP2.4 that creates HTML tables from Models.

Instructions
============

When showing results stored in a Model in CakePHP sometimes you will need to iterate through the rows in the model with code like this:

.. code-block:: php

	<?php foreach ($model as $row): ?>
	<tr>
		<td><?php echo ..?>&nbsp;</td>
		<td><?php echo ..?>&nbsp;</td>
	</tr>

However, this is a long and error-prone task. Furthermore, if you need to modify the ``class` attribute in table, rows or cells frequent changes will be necesary. Replace all your loops with a single call to this TableHelper as shown:

.. code-block:: php

	$options=array(
		"modelname"=>"Users",
		"results"=>$results_model_obtained_in_controller,
		"fields"=>array("id", "username"),
		"labels"=>array("Public ID", "User"),
		"row_class"=>array("row", "user_row"),
		"table_class"=>array("a_table", "users_table")
	);
    	$this->Table->render($options);


