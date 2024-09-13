<?php

namespace WeDevs\ORM\WP;


use WeDevs\ORM\Eloquent\Model;

class User extends Model
{
    protected $primaryKey = 'ID';
    protected $timestamp = false;

    /**
	 * Overide parent method to make sure prefixing is correct.
	 *
	 * @return string
	 */
	public function getTable()
	{
        return $this->getConnection()->db->users;
	}

    public function meta()
    {
        return $this->hasMany('WeDevs\ORM\WP\UserMeta', 'user_id');
    }
}