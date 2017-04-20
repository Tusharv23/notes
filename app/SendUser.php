<?php
namespace App;  
public class SendUser
{
	protected $user;
	public function create($user)
	{
		$this->user = $user;
	}
	public function store()
	{
		return $this->user;
	}
}
?>