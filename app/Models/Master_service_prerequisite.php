<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property integer $id
 * @property integer $m_service_id
 * @property integer $m_prerequisite_id
 * @property integer $created_by
 * @property integer $updated_by
 * @property string $type
 * @property string $deleted_at
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property User $user
 * @property MService $mService
 * @property MPrerequisite $mPrerequisite
 */
class Master_service_prerequisite extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'm_service_prerequisite';

    /**
     * The "type" of the auto-incrementing ID.
     * 
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['m_service_id', 'm_prerequisite_id', 'created_by', 'updated_by', 'type', 'deleted_at', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mService()
    {
        return $this->belongsTo('App\Models\MService');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mPrerequisite()
    {
        return $this->belongsTo('App\Models\MPrerequisite');
    }

    public function get($limit, $page, $query)
    {
        $result = $this::select('type','m_service.name as service_name', 'm_prerequisite.name as prerequisite_name')
        ->join('m_service', 'm_service_prerequisite.m_service_id', '=', 'm_service.id')
        ->join('m_prerequisite', 'm_service_prerequisite.m_prerequisite_id', '=', 'm_prerequisite.id')
        ->where(DB::raw('lower(type)'), 'like', '%' . $query . '%')
        ->orHaving(DB::raw('lower(prerequisite_name)'), 'like', '%' . $query . '%')
        ->orHaving(DB::raw('lower(service_name)'), 'like', '%' . $query . '%');
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
