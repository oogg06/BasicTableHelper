BasicTableHelper
================

A very basic Helper for CakePHP2.4 that creates HTML tables from Models.

Instructions
============

When showing results stored in a Model in CakePHP sometimes you will need to iterate through the rows in the model with code like this:


	<?php foreach ($model as $row): ?>
	<tr>
		<td><?php echo ..?>&nbsp;</td>
		<td><?php echo ..?>&nbsp;</td>
	</tr>

However, this is a long and error-prone task. Furthermore, if you need to modify the ``class`` attribute in table, rows or cells frequent changes will be necesary. Replace all your loops with a single call to this TableHelper as shown:


	$options=array(
		"modelname"=>"Users",
		"results"=>$results_model_obtained_in_controller,
		"fields"=>array("id", "username"),
		"labels"=>array("Public ID", "User"),
		"row_class"=>array("row", "user_row"),
		"table_class"=>array("a_table", "users_table")
	);
    	$this->Table->render($options);

Mandatory keys
=================
The ``modelname`` and ``results`` keys are mandatory:

* ``modelname`` stores the name of the model we want to show as a table. Remember that CakePHP retrieve not only results but also related rows from a database. In case your model contains many sub-models this option will make this Helper which one should be used in order to create a table.

* ``results`` is the model that stores results extracted by the Controller class.

Optional keys
=============

* ``fields`` is used to show only certain fields of the model.
* ``labels`` makes the table to show this labels instead of column names.
* ``row_class`` allows certain classes to be applied to rows.
* ``table_class`` applies these classes to the tables.
* 
