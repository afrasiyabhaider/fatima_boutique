<?php

namespace Responsive;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array 
     */
    
	protected $table = "product";
	
	protected $fillable = [
      'prod_id',
      'user_id',
      'prod_token',
	  'prod_slug',
	  'prod_category',
	  'prod_cat_type',
	  'prod_name',
	  'prod_desc',
	  'prod_tags',
	  'prod_price',
	  'prod_offer_price',
	  'prod_featured',
	  'prod_type',
	  'prod_zipfile',
	  'prod_external_url',
	  'prod_attribute',
	  'prod_available_qty',
	  'delete_status',
	  'prod_status'
      
    ];

    
}

