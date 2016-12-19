<?php
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App{
/**
 * App\Category
 *
 * @property integer $id
 * @property string $name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Livro[] $livros
 * @method static \Illuminate\Database\Query\Builder|Models\Category whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Category whereName($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Category whereUpdatedAt($value)
 */
	class Category extends \Eloquent {}
}

namespace App{
/**
 * App\Models\Livro
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $category_id
 * @property string $title
 * @property string $subtitle
 * @property float $price
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\User $user
 * @property-read \App\Models\Category $category
 * @method static \Illuminate\Database\Query\Builder|Models\Livro whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Livro whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Livro whereCategoryId($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Livro whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Livro whereSubtitle($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Livro wherePrice($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Livro whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Models\Livro whereUpdatedAt($value)
 */
	class Livro extends \Eloquent {}
}

namespace App{
/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string $remember_token
 * @property string $papel
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Livro[] $livros
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $readNotifications
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $unreadNotifications
 * @method static \Illuminate\Database\Query\Builder|Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|Models\User whereName($value)
 * @method static \Illuminate\Database\Query\Builder|Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|Models\User wherePapel($value)
 * @method static \Illuminate\Database\Query\Builder|Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

