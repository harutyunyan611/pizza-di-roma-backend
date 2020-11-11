<?php
  namespace App\Repositories;

  use App\Contracts\IPizzaRepository;
  use App\Pizza;
  use Illuminate\Support\Facades\Storage;
  use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

  class PizzaRepository implements IPizzaRepository {

    protected $model;

    public function __construct(Pizza $model) {
      $this->model = $model;
    }

    public function save($data) {
      if ($data->file('image')->isValid()) {
        $fileName = pathinfo($data->image->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = $data->image->extension();
        // $url = uniqid()."".$fileName.".".$fileExtension;
        $response = Cloudinary::upload($data->file('image')->getRealPath())->getSecurePath();
        // $data->image->storeAs('/public', $url);
      }

      $pizza = new $this->model;
      $pizza->name = $data->name;
      $pizza->description = $data->description;
      // $pizza->image = "/storage/".$url;
      $pizza->image = $response;
      $pizza->price = $data->price;

      $pizza->save();
      return "Pizza has been succssfully added";
    }

    public function getAllPizzas(){
      return $this->model->get();
    }
  }