<?php namespace App\Models\Device;


use Auth;
use App\User;
use Carbon\Carbon;
use App\Models\Occasion;
use Acme\Tool\Ownable\Ownable;
use Acme\Tool\Groupable\SubGroup;

use Exception;
use Illuminate\Database\Eloquent\Model;

use Acme\Tool\Likeable\Likable;
use Acme\Tool\Likeable\LikabilityTrait;

use Acme\Tool\Discussionable\Discussionable;
use Acme\Tool\Discussionable\DiscussionabilityTrait;

use Acme\Tool\Photoable\Photoable;
use Acme\Tool\Photoable\PhotoabilityTrait;

/**
 * Class Device
 * @package App\Models\Device
 */
class Device extends Model implements
    Ownable,
    Likable,
    Photoable,
    Discussionable

{
    use LikabilityTrait;
    use PhotoabilityTrait;
    use DiscussionabilityTrait;

    protected $guarded = [];

    protected $casts = [
        'is_new' => 'boolean',
        'dimension' => 'array',
        'specs' => 'array'
    ];

    protected $appends = ['coverphoto', 'cat'];

//    protected $appends = ['photos_list', 'poster_name', 'created_date',
//        'address', 'cat', 'new_text', 'isSeller', 'isLiked', 'likesCount', 'coverphoto'];
//    protected $hidden = ['poster', 'priority', 'cat_id', 'user_id'];
//    protected $dates = ['due_until'];
//    protected $lifeSpan = 1; //# month

    protected $hidden = ['user_id'];

    /**
     * @return array
     */
    public function getPhotosListAttribute()
    {
        return $this->photoFields;
    }

    /**
     * @return mixed|string
     */
    public function getCoverphotoAttribute()
    {
        $photo = $this->getFieldPhoto('coverphoto');

        return ($photo) ? $photo : '';
    }


    protected $photoFields = [
        'coverphoto', 'leftphoto', 'rightphoto',
        'backphoto', 'core1photo', 'core2photo', 'tagphoto'];

    public $photoDir = 'devices';

    public static function boot()
    {
        parent::boot();

        static::creating(function ($device) {
            $device->sn = 'sn' . (string)(Device::all()->count() + 1);
        });

        static::deleted(function ($device) {
            $device->clearAssociatedInfo();
        });
    }


//    /**
//     * Get the persona that posted the device.
//     */
//    public function poster()
//    {
//        return $this->belongsTo(User::class, 'user_id');
//    }

    /**
     * Get the persona that posted the device.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The occasions that belong to the device.
     */
    public function occasions()
    {
        return $this->belongsToMany(Occasion::class);
    }

    /**
     * @param $query
     * @param null $keyword
     * @return mixed
     */
    public function scopeKeyword($query, $keyword = null)
    {
        if (!empty($keyword)) {
            //add wildcard before and after keyword
            $keyword = '%' . $keyword . '%';

            return $query->where('title', 'like', $keyword);
        }
    }


    /**
     * @param $query
     * @return mixed
     */
//    public function scopeBeforeDue($query)
//    {
//        $today = Carbon::now()->toDateString();
//        return $query->where('due_until', '>=', $today);
//    }


    /**
     * @param $query
     * @param string $occasion
     * @return mixed
     */
    public function scopeOccasion($query, $occasion = '')
    {
        if (!is_array($occasion)) {
            $occasion = [$occasion];
        }

        if (!empty($occasion[0])) {
            return $query
                ->select('devices.*', 'device_occasion.occasion_id')
                ->join('device_occasion', 'device_occasion.device_id', '=', 'devices.id')
                ->whereIn('occasion_id', $occasion);
        }
    }


    /**
     * @param $query
     * @param null $city
     * @param array $zips
     * @return mixed
     * @internal param array $id $occasion
     */
    public function scopeLocation($query, $city = null, $zips = [])
    {
        if ($city != '') {
            if ($zips != '') {
                return $query
                    ->where('city', $city)
                    ->whereIn('zip', $zips);
            }

            return $query
                ->where('city', $city);
        }
    }


    /**
     * @param $query
     * @param number $lower
     * @param number $upper
     * @return mixed
     */
    public
    function scopePriceRange($query, $lower = null, $upper = null)
    {
        if ($lower != '' && $upper != '') {
            return $query
                ->whereBetween('price', [$lower, $upper]);
        }
    }


    /**
     * @param $query
     * @param string $voltage
     * @return mixed
     */
    public
    function scopeVoltage($query, $voltage = null)
    {
        if (!empty($voltage)) {
            return $query->where('voltage', $voltage);
        }
    }


    /**
     * @param $query
     * @param null $gasType
     * @return mixed
     */
    public
    function scopeGas($query, $gasType = null)
    {
        if (!empty($gasType)) {
            return $query->where('gas_type', $gasType);
        }
    }


    /**
     * @param $query
     * @param null $orderBy
     * @param string $sequence
     * @return null
     * @internal param null $fromSmall
     */
    public
    function scopeDoOrderBy($query, $orderBy = null, $sequence = 'asc')
    {
        if (!in_array($orderBy, ['price', 'created_at', 'reads'])) {
            return null;
        }

        if (!in_array($sequence, ['asc', 'desc'])) {
            return null;
        }


        if (!empty($orderBy)) {
            return $query->orderBy($orderBy, $sequence);
        }
    }

    /**
     * @param $query
     * @param number $cat_id
     * @return mixed
     */
    public
    function scopeCat($query, $cat_id = null)
    {
        if (!empty($cat_id)) {
            return $query->where('cat_id', $cat_id);
        }
    }


    /**
     * @param $query
     * @param $admin
     * @return mixed
     */
    public function scopePublished($query, $admin = false)
    {
        if ($admin) {
            return null;
        }

        return $query->where('published', true);
    }

//    /**
//     * @return mixed
//     */
//    public
//    function getPosterNameAttribute()
//    {
//        return $this->poster->name;
//    }


    public
    function getCreatedDateAttribute()
    {
        return $this->created_at->toDateString();
        return $this->created_at->diffForHumans();
    }

    public
    function getCatAttribute()
    {
        return SubGroup::whereId($this->cat_id)->first();
    }


    public
    function getNewTextAttribute()
    {
        return ($this->is_new) ? '全新' : '二手';
    }

    public
    function getIsSellerAttribute()
    {
        return $this->user_id == Auth::id();
    }

    public
    function getIsLikedAttribute()
    {
        return !!$this->isLiked();
    }


//    public function togglePublish()
//    {
//        $this->allowOnlyOwner();
//
//        return ($this->active) ?
//            $this->unPublish() :
//            $this->publish();
//    }


//    public function publish()
//    {
//        $this->allowOnlyOwner();
//
//        $this->active = true;
//        $this->due_until = $this->generateDue($this->lifeSpan);
//        $this->save();
//
//        return $this;
//    }


    /**
     * @param $month
     * @return static
     */
    private function generateDue($month)
    {
        return Carbon::now()->addMonth($month);
    }

//    public function unPublish()
//    {
//        $this->allowOnlyOwner();
//        $this->active = false;
//        $this->due_until = null;
//        $this->save();
//
//        return $this;
//    }

    protected function allowOnlyOwner()
    {
        if (!auth()->check() || auth()->user()->id != $this->user_id) {
            throw new Exception('Only the owner of the device could make this item public.');
        }
    }


    private function clearAssociatedInfo()
{
    $this->likes()->delete();
    $this->discussions()->delete();
    $this->occasions()->sync([]);
    $this->deletePhoto($this);
}


    private function deletePhoto($device)
    {
        $device->photos()->each(function ($item) {
            $item->delete();
        });
    }

    public function ownedBy(User $user)
    {
        return $this->user_id == $user->id;
    }

    /**
     * @return int
     */
//    public function getLifeSpan()
//    {
//        return $this->lifeSpan;
//    }
}
