<?php

namespace App\Controllers;
use Framework\Database;
use Framework\Validation;

class ListingController
{
    protected $db;

    public function __construct()
    {
        $config = require basePath('config/db.php');
        $this->db = new Database($config);
    }

    public function index()
    {
        $listings = $this->db->query('SELECT * FROM listing')->fetchAll();

        loadView('listings/index',[
            'listings'=>$listings
        ]);
    }

    public function create()
    {
        loadView('listings/create');
    }

    public function show($params)
    {
        $id = $params['id'] ?? '';

        $params = [
            'id' => $id
        ];

        $listing = $this->db->query('SELECT * FROM listing WHERE id = :id',$params)->fetch();

        
        if(!$listing){
            ErrorController::notFound('该岗位不存在！');
            return;
        }


        loadView('listings/show',[
            'listing'=>$listing
        ]);
    }


    /**
     * 
    * @return void
    */

    public function store()
    {
        $allowedFields=['title','description','salary','tags','company','address','city','province','phone','email','requirements','benefits'];

        $newListingData = array_intersect_key($_POST,array_flip($allowedFields));

        $newListingData['user_id'] = 1;

        $newListingData = array_map('sanitize',$newListingData);

        $requiredFields = ['title','description','email','city','province'];

        $errors = [];
        foreach ($requiredFields as $field){
            if(empty($newListingData[$field]) || !Validation::string($newListingData[$field])){
                $errors[$field] = ucfirst($field) . '为必需项';
            }
        }

        if(!empty($errors)){
            loadView('listings/create',[
                'errors' => $errors,
                'listing' => $newListingData
            ]);
        }else{
            $fields =[];

            foreach ($newListingData as $field => $value){
                $fields[] = $field; 
            }
            $fields = implode(', ',$fields);
            $values = [];

            foreach($newListingData as $field => $value){
                if($value === ''){
                    $newListingData[$field] = null;
                }
                $values[] = ':' . $field;
            }

            $values = implode(', ',$values);
            $query = "INSERT INTO listing({$fields}) VALUES ({$values})";
            $this->db->query($query,$newListingData);
            redirect('/listings');
        }
    }
}