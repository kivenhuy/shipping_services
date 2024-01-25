<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $appends = ['img_logo','img_id'];
    protected $fillable = [
        'name',
        'user_type',
        'email', 
        'password', 
        'country', 
        'city', 
        'district', 
        'ward', 
        'phone', 
        'address',
        'national_id',
        'carrier_id',
        'approved',
        'id_proof',
        'avatar_original',
        'email_verified_at'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function shipper_detail()
    {
        return $this->hasOne(ShipperDetail::class);
    }

    

    public function getImgLogoAttribute()
    {
        $data =uploaded_asset($this->avatar_original);
        return $data;
    }

    public function getImgIdAttribute()
    {
        $data =uploaded_asset($this->id_proof);
        return $data;
    }

    public function getVehicleImageAttribute()
    {
        $arr_data = [];
        $data_uploads = $this->shipper_detail->vehicle_image;
        if(isset($data_uploads))
        {
            if (str_contains($data_uploads, ',')) {
                $data_uploads = explode(",", $data_uploads);
                foreach($data_uploads as $data_photo)
                {
                    // $data_images = Uploads::findOrFail($data_photo);
                    array_push($arr_data,uploaded_asset($data_photo));
                }
            }
            else
            {
                
                array_push($arr_data,uploaded_asset($data_uploads));
            }  
        }
        return $arr_data;
    }

    public function getLicenseImageAttribute()
    {
        $arr_data = [];
        $data_uploads = $this->shipper_detail->driver_license;
        if(isset($data_uploads))
        {
            if (str_contains($data_uploads, ',')) {
                $data_uploads = explode(",", $data_uploads);
                foreach($data_uploads as $data_photo)
                {
                    // $data_images = Uploads::findOrFail($data_photo);
                    array_push($arr_data,uploaded_asset($data_photo));
                }
            }
            else
            {
                
                array_push($arr_data,uploaded_asset($data_uploads));
            }  
        }
        return $arr_data;
    }
}
