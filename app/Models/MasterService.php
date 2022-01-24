<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $code
 * @property string $name
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 * @property MDepartementService[] $mDepartementServices
 * @property MServicePrerequisite[] $mServicePrerequisites
 * @property TService[] $tServices
 */
class MasterService extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'm_service';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['created_by', 'updated_by', 'code', 'name', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mDepartementServices()
    {
        return $this->hasMany('App\Models\MDepartementService');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function mServicePrerequisites()
    {
        return $this->hasMany('App\Models\MServicePrerequisite');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tServices()
    {
        return $this->hasMany('App\Models\TService');
    }

    public function get($limit, $page, $query)
    {
        $result = $this::where(function ($q) use ($query) {
            $q->where(DB::raw('lower(code)'), 'like', '%' . $query . '%')
                ->orWhere(DB::raw('lower(name)'), 'like', '%' . $query . '%')
                ->get();
        });
        return $result->paginate($limit, '*', 'page', $page);
    }

    public function insert($data)
    {
        return DB::table($this->table)->insert($data);
    }

    public function updateData($data)
    {
        return $this::where('id', $data['id'])->update($data);
    }

    public function deleteData($data)
    {
        return $this::where('id', $data['id'])->delete();
    }
}
