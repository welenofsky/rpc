<?php

namespace RPC\Db\Table\Adapter;

use RPC\Db\Table\Adapter;

/**
 * SQLite driver implementation as a base for all model classes, mapping a table
 *
 * @package Db
 */
class SQLite extends MySQL
{
	public function loadFields()
	{
		/**
		 * I store the fields in a global variable for performance reasons: if
		 * the table is instantiated more than once, then the query and field
		 * building is done only once
		 */
		if( ! empty( $GLOBALS['_RPC_']['models'][$this->getName()]['fields'] ) )
		{
			$this->fields      = $GLOBALS['_RPC_']['models'][$this->getName()]['fields'];
		}
		else
		{
			$res = $this->getDb()->query("PRAGMA table_info(`{$this->getName()}`)");

			$table_prefix = str_replace( $this->getDb()->getPrefix(), '', $this->getName() ) . '_';
			foreach( $res as $row )
			{
				$this->fields[] = $row['name'];
			}

			$res = null;

			$GLOBALS['_RPC_']['models'][$this->getName()]['fields']      = $this->fields;
		}
	}
}