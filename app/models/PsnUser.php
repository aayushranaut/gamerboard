<?php

class PsnUser extends \Eloquent {
	protected $fillable = ['username', 'level', 'trophies', 'bronze', 'silver', 'platinum', 'gold', 'progress', 'avatar_url'];

	public function PsnUserRequestsCount() {
		return $this->belongsToMany('PsnUserUser')
			->selectRaw('count(psn_user_user) as aggregate')
			->groupBy('pivot_psn_user_id');
	}

	public function getPsnUsersCountAttribute() {
		if (!array_key_exists('psn_users_count', $this->relations)) {
			$this->load('ordersCount');
		}
	}
}