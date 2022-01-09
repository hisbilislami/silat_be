<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property integer $updated_by
 * @property string $nik
 * @property string $name
 * @property string $no_telepon
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property TService[] $tServices
 */
class Applicant extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'm_applicant';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['updated_by', 'nik', 'name', 'no_telepon', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'updated_by');
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
            $q->where(DB::raw('lower(nik)'), 'like', '%' . $query . '%')
                ->orWhere(DB::raw('lower(name)'), 'like', '%' . $query . '%')
                ->orWhere(DB::raw('lower(no_telepon)'), 'like', '%' . $query . '%')
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
