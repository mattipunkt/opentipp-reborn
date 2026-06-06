<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
        'is_accepted',
        'points',
        'first_name',
        'profile_picture',
        'location',
        'rank',
        'slogan'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::created(function (User $user) {
            // $user->profile()->create();

            $games = Game::all();
            foreach ($games as $game) {
                Vote::create([
                    'user_id' => $user->id,
                    'game_id' => $game->id,
                ]);
            }
            $user->profile_picture = "iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAABHNCSVQICAgIfAhkiAAAAAlwSFlzAAAuIwAALiMBeKU/dgAAABl0RVh0U29mdHdhcmUAd3d3Lmlua3NjYXBlLm9yZ5vuPBoAAAMISURBVGiB7djfi5RVHMfxl5YuEvlj3Sx/gBFkkVuWpQSh4a8wKehOFkMMoSC6LFgjiO4kiKK7sOwfKNaL/oCuAgtRQUQEdUV21SJS1HXTtrw4Z5jzrDOz88zzzA7B84YDZ2a+3+/5nGee8z3ne6ioqKj4PzGnS3GX4g28guXxu3H8gp/wZ5fGLY1+fIlJ/NekTeILLOmRxhkZxHnNJzC9ncPasgYv69V6AkcxkHw3hhGcjZ+fwltYmdj8gY0YLUlHIR7ACfUn/Q+GMb+BbR8ORJua/bEYo+fsVxf1L3a34TMUbWt++7olLg/H1AUdyuF3OPH7rQu6crFK9sk+mcN3jew/uaJ0dTnYloi50IH/xcR/axEhc4s4Y1nSv9yB/1jSf7SIkKITuZb0F3fgn26KfxXUUohnZNPuQGvzDI/IpuGnS1eXk1F1MR/n8Psk8Ttfvqz8fKYu6AaebcPnOdxM/D7tmrocLMTv6qKuYFML+83RJrV/uMsa22Y77sruCz8Iu/xgbLvxo+y+cwdbeqC3JUO4rf3T74T2jjM9YQN+NfMkjuLFHmlsmznYhe9wWkgAN2L/W7yue5VpRUXZlPWu9uF5vCQc5R8Xbk/mYVG0uS6k6HHh1HtWqGVO4O+SdHREH97GESGVtpt2G6XhEeyJMWeNBcKZ6moB8c3aVaGmX5BXVN5Xawu+x+oGv03gOE4KB8kx3IoNHoptVfRfh/VNRI/iHfycU19bfIQp2Sd4U6jTdwjrIS/z8Jqwv9yaFnsKHxZWPY3haYNM4qBybwv78bmw8NOxhssaYKdsATSGl8sK3oD1srX8FN4sGvQxIW3Wgp5Rv5TuJsvjWLVxrylY03+dBLsulLazxRqhjq+N/1WngQZkb9XfL0NdTj6QXZdLOwmyLwlySWdZqSjzhTVZ07G3mWGr66DNSX9EOF7MNnfi2DVebWb4YIsg6aIewLsFRXVKf9Jveq3aaiLjSX8otl4zPrPJ/byg2GGw7DYRNTVkprPWIN7T+1vAM/gGp3qso6KioqIk7gFDQi8ogTCjPQAAAABJRU5ErkJggg==";
            $user->save();
        });

        static::deleting(function (User $user) {
            Vote::where('user', $user->id)->delete();
        });
    }

    public function votes(): HasMany
    {
        return $this->hasMany(Vote::class);
    }

    public function isAdmin(): bool
    {
        return $this->is_admin;
    }

    public function winnerBet(): HasOne {
        return $this->hasOne(Team::class, 'id', 'team_id');
    }
}
