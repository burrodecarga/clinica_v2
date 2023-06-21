<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;


class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;
    use \App\Traits\AppTraits;



    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'birthdate',
        'address',
        'phone',
        'gender',
        'is_doctor',
        'active'
    ];

    protected $table = "users";

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'birthdate',
        'age',
        'edad'
        // your other new column
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected static function booted(): void
    {
        static::creating(function (User $user) {
              $user->birthdate = now();
        });
    }

    public function specialties()
    {
        return $this->belongsToMany(Specialty::class);
    }

    public function offices()
    {
        return $this->hasMany(Office::class, 'doctor_id');
    }

    public function socials()
    {
        return $this->belongsToMany(Social::class)->withPivot('url');
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function schools()
    {
        return $this->hasMany(School::class);
    }

    public function appoinments()
    {
        return $this->hasMany(Appoinment::class);

    }

    public function interviews()
    {
return $this->hasMany(Interview::class);

    }


    public function disases()
    {
        return $this->belongsToMany(Disase::class)->withPivot(['id', 'year', 'condition', 'inherited', 'deceased', 'doctor', 'name', 'observation'])->withTimestamps()->orderBy('pivot_year', 'desc');

    }

    public function surgeries()
    {
        return $this->belongsToMany(Surgery::class)->withPivot(['name', 'year', 'type', 'observation', 'id'])->withTimestamps()->orderBy('pivot_year', 'desc');
    }

    public function antecedents()
    {
        return $this->belongsToMany(Antecedent::class)->withPivot(['id', 'year', 'name', 'observation', 'date'])->withTimestamps()->orderBy('name')->orderBy('year', 'desc');

    }

    public function habits()
    {
        return $this->belongsToMany(Habit::class)->withPivot(['id', 'type', 'name', 'slug', 'quantity', 'frecuency', 'severity', 'time', 'observation'])->withTimestamps()->orderBy('name')->orderBy('type');
    }

    public function symptoms()
    {
        return $this->belongsToMany(Symptom::class)->withPivot(['id', 'name'])->withTimestamps()->orderBy('name');
    }


    public function keys()
    {
        return $this->belongsToMany(Key::class)->withPivot(['id', 'name','value_str','value_num','interview_id','key_id','user_id'])->withTimestamps()->orderBy('name');
    }


    public function allergies()
    {
        return $this->belongsToMany(Pathology::class,'pathology_user','user_id','pathology_id')->withPivot(['allergy'])->withTimestamps()->orderBy('name');
    }

    public function files(){
        return $this->hasMany(File::class)->orderBy('created_at','desc');;
    }

    public function vaccines()
    {
        return $this->belongsToMany(Vaccine::class)->withPivot(['date','vaccine_id'])->withTimestamps()->orderBy('date', 'desc');
    }

    public function pathologies()
    {
        return $this->belongsToMany(Pathology::class)->withTimestamps();
    }


    public function sons(){
        return $this->belongsToMany(User::class,'user_son','father_id','son_id');
    }

    public function father(){
        return $this->belongsToMany(User::class,'user_son','son_id','father_id');
    }

    public function parameters()
    {
        return $this->belongsToMany(Parameter::class)->withPivot(['proof','proof_id','name','date','value'])->withTimestamps()->orderBy('date', 'desc');
    }




    public function age()
    {
        return Carbon::parse($this->attributes['birthdate'])->age;
    }


public function edad()
{
    return  Carbon::parse($this->attributes['birthdate'])->diff(Carbon::now())->format('%y años, %m meses and %d días');

}

}
