<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	public static $rules = array(
	    'username'=>'required|alpha_num|min:4|unique:users',
	    'email'=>'required|email|unique:users',
	    'password'=>'required|min:6|confirmed',
	    'password_confirmation'=>'required|min:6'
    );

	protected $table = 'users';

	protected $fillable = array('username', 'email', 'profile');
	protected $hidden = array('password');

	

	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	public function getAuthPassword()
	{
		return $this->password;
	}

	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}

	public function garage()
	{
		return $this->belongsTo('Garage');
	}

	public function messages()
	{
		return $this->hasMany('Message', 'reciever');
	}

	public function boosts() {
		return $this->belongsToMany('Boost')->withPivot('finished');
	}

	public function clubs() {
		return $this->belongsToMany('Club')->withPivot('chat_read', 'approved');
	}

	public function bugs() {
		return $this->hasMany('Bug');
	}

	public function ideas() {
		return $this->hasMany('Idea');
	}

	public function attributes() {
		return $this->belongsToMany('Attribute')->with('point');
	}

	public function attribute_user() {
		return $this->hasMany('AttributeUser');
	}

	public function factories() {
		return $this->belongsToMany('Factory')->withPivot('latest_delivery','upgrade');
	}

	public function town() {
		return $this->belongsTo('Town');
	}

	public function vehicle() {
		return $this->belongsTo('Vehicle');
	}

	public function items() {
		return $this->belongsToMany('Item')->withPivot('in_storage','in_vehicle');
	}

	// Get many to many fields
	public function getUserAttribute($attribute_id) {
		return AttributeUser::
			where('user_id', '=', $this->id)
			->where('attribute_id', '=', $attribute_id)
			->first();
	}

	public function getIntelligence() {
		return AttributeUser::
			where('user_id', '=', $this->id)
			->where('attribute_id', '=', 1)
			->first()
			->point;
	}

	public function getAgility() {
		return AttributeUser::
			where('user_id', '=', $this->id)
			->where('attribute_id', '=', 2)
			->first()
			->point;
	}

	public function getItem($item_id) {
		return ItemUser::
			where('user_id', '=', $this->id)
			->where('item_id', '=', $item_id)
			->first();
	}

	// Add attribute points to the specific attribute
	public static function resetUsersForNewRound() {
		$users = User::all();

		foreach( $users as $user ) {
			$user->garage_id = 1;
			$user->vehicle_id = 1;
			$user->town_id = null;
			$user->current_town = null;
			$user->money = 0;
			$user->experience = 100;
			$user->level = 1;
			$user->bikes = 0;
			$user->cooldown = "0000-00-00 00:00:00";
			$user->last_login = "0000-00-00 00:00:00";

			foreach (AttributeUser::all() as $u_a) {
				$u_a->point = 1;
				$u_a->save();
			}

			foreach (Club::all() as $club) {
				$club->delete();
			}

			foreach (FactoryUser::all() as $f_a) {
				$f_a->latest_delivery = NULL;
				$f_a->activated = NULL;
				$f_a->active = 0;
				$f_a->upgrade = 0;
				$f_a->save();
			}

			foreach (ItemUser::all() as $i_a) {
				$i_a->in_storage = 10;
				$i_a->in_vehicle = 0;
				$i_a->save();
			}

			foreach (ItemMarket::all() as $i_m) {
				$i_m->amount = 2500;
				$i_m->save();
			}

			$user->save();
		}

		return true;
	}

	public function addAttributePoints($attribute_id, $points_to_add) {
		$attribute_user = AttributeUser::
			where('user_id', '=', $this->id)
			->where('attribute_id', '=', $attribute_id)
			->first();

		$attribute_user->point += $points_to_add;
		$attribute_user->save();
	}

	public function setAttributePoints($attribute_id, $points_value) {
		$attribute_user = AttributeUser::
			where('user_id', '=', $this->id)
			->where('attribute_id', '=', $attribute_id)
			->first();

		$attribute_user->point = $points_value;
		$attribute_user->save();
	}


	// Custom functions..
	public static function getInloggedUsers() {
		$current_date = new DateTime;
		$current_date->modify('-15 minutes');

		// Get the inlogged users
		$inlogged_users = User::
			where('last_login', '>=', $current_date)
			->orWhere('updated_at', '>=', $current_date)
			->count();

		return $inlogged_users;
	}

	public function getUnreadMessages() {
		return $this->messages()->where('read', '=', false);
	}

	public function getActiveFactories() {
		return FactoryUser::
			where('user_id', '=', $this->id)
			->where('active', '=', true)
			->get();
	}

	public function getActiveFactoriesCount() {
		return FactoryUser::
			where('user_id', '=', $this->id)
			->where('active', '=', true)
			->count();
	}

	public function getInactiveFactories() {
		return FactoryUser::
			where('user_id', '=', $this->id)
			->where('active', '=', false)
			->get();
	}

	public function getRecommendedGarage() {

		try {
			$garage = Garage::
				where('price', '<=', Auth::user()->money)
				->where('id', '>', $this->garage_id)
				->orderBy('price', 'DESC')
				->firstOrFail();
			return $garage;
		} catch (Exception $e) {
			return null;		
		}
	}

	public function getComingGarages() {

		$garages = Garage::where('id', '>', Auth::user()->garage_id)->take(6)->get();

		return $garages;
	}

	public function getRecommendedVehicle() {

		try {
			$vehicle = Vehicle::
				where('price', '<=', Auth::user()->money)
				->where('id', '>', $this->vehicle_id)
				->where('required_level', '<=', $this->level)
				->orderBy('price', 'DESC')
				->firstOrFail();
			return $vehicle;
		} catch (Exception $e) {
			return null;		
		}
	}

	public function getComingVehicles() {

		$vehicles = Vehicle::where('id', '>', Auth::user()->vehicle_id)->take(6)->get();

		return $vehicles;
	}

	public function getVehicleItemCount() {
		$item_count = 0;
		foreach ($this->items()->get() as $item) {
			$item_count += $item->pivot->in_vehicle;
		}

		return $item_count;
	}

	public function getStorageItemCount() {
		$item_count = 0;
		foreach ($this->items()->get() as $item) {
			$item_count += $item->pivot->in_storage;
		}

		return $item_count;
	}

	public function currentTown() {
		if($this->current_town) {
			return Town::find($this->current_town)->name;
		} else {
			return 'Ingemansland';
		}
	}

	public function inHomeTown() {
		return ($this->town_id == $this->current_town);
	}

	public function hasBoost($type) {
		$has_boost = false;
		$date_now = new Datetime('now');
		$date_now = $date_now->format('Y-m-d h:i:s');

		foreach ($this->boosts()->get() as $user_boost) {
			if($user_boost->type == $type && $user_boost->pivot->finished >= $date_now) {
				$has_boost = true;
				continue;
			}
		}
		return $has_boost;
	}

	public function getBoost($type) {
		$boost = $this->boosts()->where('type', '=', $type)->first();
		if(isset($boost)) {
			return $boost;
		} else {
			return false;
		}
	}

	public function getRemainingCooldown() {
		$current_time = new DateTime('now');
		$current_time = $current_time->getTimestamp();

		$cooldown = new DateTime($this->cooldown);
		$cooldown = $cooldown->getTimestamp();

		return ($cooldown - $current_time) > 0 ? ($cooldown - $current_time) : 0;
	}

	// Get cooldown after calculation with users Agility and possible paid bonuses
    /**
     * @param $base_cooldown
     * @return int
     */
    public function getCalculatedCooldown($base_cooldown) {
		$cooldown = (int)($base_cooldown * (1 - ($this->getAgility() * 0.005)));
		if($this->hasBoost(1)) {
			$cooldown = $boosted_cooldown = ($cooldown*0.75);
		}
		return $cooldown;
	}

	// Get price after calculation with users Intelligence and possible paid bonuses
    /**
     * @param $base_price
     * @return int
     */
    public function getCalculatedPrice($base_price) {
        $price = (int)($base_price * (1 + ($this->getIntelligence() * 0.01)));
		if($this->hasBoost(2)) {
			$price = $boosted_price = ($price*1.5);
		}
		return $price;
	}

	// Get current level
	public function getLevel() {
		return $this->level;
	}

	// Add experience to the user
    /**
     * @param $experience
     * @return mixed
     */
    public function addExp($experience) {
		if($this->hasBoost(3)) {
			$experience = $boosted_experience = $experience + ($experience / 2);

			$this->experience += $experience;
		} else {
			$this->experience += $experience;
		}

		return $experience;
	}

	// Get the experience required for the next level
	public function getNextLevelExp() {
		return pow(($this->level + 1), 2) * 100;
	}

	// Get the experience for the next level minus current levels experience
	public function getNextLevelExpSubCurrentLevelExp() {
		return ($this->getNextLevelExp() - $this->getCurrentLevelExp());
	}

	// Get the experiecne for the current level
	public function getCurrentLevelExp() {
		return pow(($this->level), 2) * 100;
	}

	// Get the experience for current level minus current experience
	public function getCurrentLevelExpSubCurrentExp() {
		return $this->experience - $this->getCurrentLevelExp();
	}

	// Get the percent done to gain a new level.
	public function getNextLevelPercent() {
		return round((($this->experience - $this->getCurrentLevelExp()) / ($this->getNextLevelExp() - $this->getCurrentLevelExp())) * 100);
	}

}