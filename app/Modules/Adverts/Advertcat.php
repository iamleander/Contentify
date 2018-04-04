<?php

namespace App\Modules\Adverts;

use BaseModel;
use SoftDeletingTrait;

/**
 * @property \Carbon $deleted_at
 * @property string $title
 * @property int $creator_id
 * @property int $updater_id
 * @property \App\Modules\Adverts\Advert[] $adverts
 * @property \User $creator
 */
class Advertcat extends BaseModel
{

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

    protected $fillable = ['title'];
    
    protected $rules = [
        'title'     => 'required|min:3',
    ];

    public static $relationsData = [
        'adverts'   => [self::HAS_MANY, 'App\Modules\Adverts\Advert', 'dependency' => true],
        'creator'   => [self::BELONGS_TO, 'User', 'title' => 'username'],
    ];

}