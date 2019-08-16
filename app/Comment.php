<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    /**
    * Get the comment author's name
    *
    * @param  string|null $name Comment author's name column
    * @return string
    */
    public function getAuthorNameAttribute($name)
    {
        if ($this->user_id == null) {
            return $name;
        }
        
        return $this->user->name;
    }
  
    /**
    * Get the comment author's email
    *
    * @param  string|null $email Comment author's email column
    * @return string
    */
    public function getAuthorEmailAttribute($email)
    {
        if ($this->user_id == null) {
            return $email;
        }
        
        return $this->user->email;
    }
  
    /**
    * Get the comment author's website
    *
    * @param  string|null $website Comment author's website column
    * @return string
    */
    public function getAuthorWebsiteAttribute($website)
    {
        if ($this->user_id == null) {
            return $website;
        }
        
        return $this->user->website;
    }
    
    /**
     * Get comment author user model
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get comment replies
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function replies()
    {
        
        return $this->hasMany(Comment::class, 'parent_id');
    }
}
